<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['action']) && $data['action'] == 'delete') {
        $title = $data['title'];
        $articles = json_decode(file_get_contents('articles.json'), true);
        $articleFound = false;

        foreach ($articles as $key => $article) {
            if (strtolower($article['title']) == strtolower($title)) {
                $articleFound = true;
                // Delete the image file
                if (file_exists($article['image'])) {
                    unlink($article['image']);
                }
                // Remove the article from the array
                unset($articles[$key]);
                break;
            }
        }

        if ($articleFound) {
            // Re-index the array and save it back to the JSON file
            $articles = array_values($articles);
            file_put_contents('articles.json', json_encode($articles));
            echo "Article and associated image deleted successfully!";
        } else {
            echo "Article not found!";
        }
    } else {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $content = $_POST['content'];
        $date = $_POST['date'];
        $image = $_FILES['image'];

        // Directory to save uploaded images
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($image["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($image["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($image["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($image["tmp_name"], $target_file)) {
                // Save article details to a JSON file or database
                $articles = json_decode(file_get_contents('articles.json'), true);
                $newArticle = [
                    'id' => time(),
                    'title' => $title,
                    'description' => $description,
                    'content' => $content,
                    'date' => $date,
                    'image' => $target_file
                ];
                $articles[] = $newArticle;
                file_put_contents('articles.json', json_encode($articles));
                echo "The file ". htmlspecialchars(basename($image["name"])). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}
?>