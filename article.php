<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "12345";
$database = "article_management";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra xem có dữ liệu POST không
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $id = intval($_POST['id']);
    $type = $conn->real_escape_string($_POST['type']);
    $description = $conn->real_escape_string($_POST['description']);
    $content = $conn->real_escape_string($_POST['content']);
    $date = $conn->real_escape_string($_POST['date']);

    // Tạo câu lệnh SQL để chèn dữ liệu
    $sql = "INSERT INTO BaiViet (id, the_loai, mo_ta, noi_dung, ngay_dang) VALUES (?, ?, ?, ?, ?);";

    // Chuẩn bị và thực thi truy vấn
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("issss", $id, $type, $description, $content, $date);

        if ($stmt->execute()) {
            echo "Thêm bài viết thành công!";
        } else {
            echo "Lỗi: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Lỗi chuẩn bị câu lệnh: " . $conn->error;
    }
}

// Đóng kết nối
$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm bài viết</title>
</head>
<body>
    <h1>Thêm bài viết vào cơ sở dữ liệu</h1>
    <form method="POST" action="">
        <label for="id">ID bài viết:</label>
        <input type="number" name="id" id="id" required><br><br>

        <label for="type">Thể loại bài viết:</label>
        <input type="text" name="type" id="type" required><br><br>

        <label for="description">Mô tả bài viết:</label>
        <textarea name="description" id="description" required></textarea><br><br>

        <label for="content">Nội dung bài viết:</label>
        <textarea name="content" id="content" required></textarea><br><br>

        <label for="date">Ngày đăng bài viết:</label>
        <input type="date" name="date" id="date" required><br><br>

        <button type="submit">Thêm bài viết</button>
    </form>
</body>
</html>
