<?php
// Kết nối cơ sở dữ liệu (giống như trong view.html)

// Xử lý việc thêm bài viết
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $content = $_POST["content"];

    // Upload file ảnh
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Chèn dữ liệu vào cơ sở dữ liệu
    $sql = "INSERT INTO posts (title, description, content, image) VALUES ('$title', '$description', '$content', '$target_file')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Thêm bài viết thành công'); window.location.href = 'view.html';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>