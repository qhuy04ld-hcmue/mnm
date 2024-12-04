cách run project:
copy 4 file: add.html, view.html, upload.php, article.json vào trong C:\xampp\htdocs\myproject
để 2 file html dạng url nếu muốn liên kết: 
http://localhost/myproject/add.html
http://localhost/myproject/view.html
Bật xampp: run MySQl , Apache lên
bash:
npm start




















TypeScipt
ReactJS
PHP
XAMPP
MySQL
code php ket noi co so du lieu
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