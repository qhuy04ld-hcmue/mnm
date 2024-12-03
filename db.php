<?php
$servername = "localhost";
$username = "root"; // Tên người dùng MySQL
$password = "12345"; // Mật khẩu MySQL (mặc định là rỗng trên XAMPP/WAMP)
$dbname = "testdb"; // Tên cơ sở dữ liệu bạn muốn kết nối

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
echo "Kết nối thành công!";
?>
/*
    Ping 192.168.56.103 trong ubuntu với sudo su
    mở xampp chạy apache và mysql
    tạo file trong C:\xampp\htdocs\myproject\db.php
    chạy link này trên web:
    localhost/myproject/db.php
*/