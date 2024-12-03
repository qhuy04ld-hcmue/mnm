
<?php
// Kết nối đến cơ sở dữ liệu MySQL
$servername = "localhost";
$username = "root";
$password = "12345"; // Đảm bảo rằng bạn đã thiết lập đúng mật khẩu
$database = "article_management"; // Tên cơ sở dữ liệu

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Xử lý nếu người dùng nhấn nút "Thêm bài viết"
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $the_loai = $_POST['the_loai'];
    $mo_ta = $_POST['mo_ta'];
    $noi_dung = $_POST['noi_dung'];
    $ngay_dang = $_POST['ngay_dang'];

    // Kiểm tra nếu id đã tồn tại
    $check_sql = "SELECT id FROM BaiViet WHERE id = '$id'";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        $message = "ID đã tồn tại. Vui lòng sử dụng ID khác.";
    } else {
        // Thêm bài viết vào cơ sở dữ liệu
        $sql = "INSERT INTO BaiViet (id, the_loai, mo_ta, noi_dung, ngay_dang) VALUES ('$id', '$the_loai', '$mo_ta', '$noi_dung', '$ngay_dang')";
        
        if ($conn->query($sql) === TRUE) {
            $message = "Bài viết đã được thêm thành công!";
        } else {
            $message = "Lỗi: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Lấy danh sách bài viết từ cơ sở dữ liệu
$query = "SELECT id, the_loai, mo_ta, noi_dung, ngay_dang FROM BaiViet ORDER BY ngay_dang DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm bài viết</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 800px;
            margin: auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        textarea {
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #218838;
        }

        .message {
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
            color: green;
        }

        .articles {
            margin-top: 30px;
        }

        .article {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }

        .article h2 {
            margin: 0;
            font-size: 18px;
            color: #333;
        }

        .article p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Thêm bài viết</h1>
        <?php if (isset($message)) { ?>
            <div class="message"><?php echo $message; ?></div>
        <?php } ?>
        <form method="post" action="">
            <label for="id">ID:</label>
            <input type="number" id="id" name="id" required>
            
            <label for="the_loai">Thể loại:</label>
            <input type="text" id="the_loai" name="the_loai" required>
            
            <label for="mo_ta">Mô tả:</label>
            <textarea id="mo_ta" name="mo_ta" required></textarea>
            
            <label for="noi_dung">Nội dung:</label>
            <textarea id="noi_dung" name="noi_dung" required></textarea>
            
            <label for="ngay_dang">Ngày đăng:</label>
            <input type="date" id="ngay_dang" name="ngay_dang" required>

            <button type="submit">Thêm bài viết</button>
        </form>

        <div class="articles">
            <h2>Danh sách bài viết</h2>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="article">';
                    echo '<h2>ID: ' . htmlspecialchars($row['id']) . ' - Thể loại: ' . htmlspecialchars($row['the_loai']) . '</h2>';
                    echo '<p><strong>Mô tả:</strong> ' . htmlspecialchars($row['mo_ta']) . '</p>';
                    echo '<p><strong>Nội dung:</strong> ' . htmlspecialchars($row['noi_dung']) . '</p>';
                    echo '<p><strong>Ngày đăng:</strong> ' . htmlspecialchars($row['ngay_dang']) . '</p>';
                    echo '</div>';
                }
            } else {
                echo '<p>Không có bài viết nào.</p>';
            }
            ?>
        </div>
    </div>
</body>
</html>
