<?php
// Kết nối đến cơ sở dữ liệu MySQL
$servername = "localhost";
$username = "root";
$password = "12345";
$database = "article_management";

$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Xử lý lưu trữ form bài viết
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $the_loai = $_POST['the_loai'];
    $mo_ta = $_POST['mo_ta'];
    $noi_dung = $_POST['noi_dung'];
    $ngay_dang = date('Y-m-d'); // Ngày đăng tự động lấy ngày hiện tại

    // Chuẩn bị câu lệnh SQL
    $stmt = $conn->prepare("INSERT INTO BaiViet (the_loai, mo_ta, noi_dung, ngay_dang) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $the_loai, $mo_ta, $noi_dung, $ngay_dang);

    // Thực thi câu lệnh SQL
    if ($stmt->execute()) {
        echo "<p>Bài viết đã được lưu thành công!</p>";
    } else {
        echo "<p>Lỗi: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

// Đóng kết nối
$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Bài Viết</title>
</head>
<body>
    <h1>Form Nhập Bài Viết</h1>
    <form method="POST" action="">
        <label for="the_loai">Thể Loại:</label><br>
        <input type="text" id="the_loai" name="the_loai" required><br><br>

        <label for="mo_ta">Mô Tả:</label><br>
        <textarea id="mo_ta" name="mo_ta" required></textarea><br><br>

        <label for="noi_dung">Nội Dung:</label><br>
        <textarea id="noi_dung" name="noi_dung" required></textarea><br><br>

        <button type="submit">Lưu Bài Viết</button>
    </form>

    <h1>Danh Sách Bài Viết</h1>
    <?php
    // Kết nối lại cơ sở dữ liệu để hiển thị bài viết
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Lấy danh sách bài viết từ cơ sở dữ liệu
    $sql = "SELECT * FROM BaiViet ORDER BY ngay_dang DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li><strong>" . htmlspecialchars($row['the_loai']) . "</strong> - " . htmlspecialchars($row['ngay_dang']) . "<br>";
            echo "<em>" . htmlspecialchars($row['mo_ta']) . "</em><br>";
            echo "<p>" . htmlspecialchars($row['noi_dung']) . "</p></li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Không có bài viết nào.</p>";
    }

    // Đóng kết nối
    $conn->close();
    ?>
</body>
</html>
