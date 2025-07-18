<?php
// Tạo bảng users trong database ex03 nếu chưa có
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'ex03';

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die('Kết nối thất bại: ' . mysqli_connect_error());
}

// Tạo bảng users nếu chưa có
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE
)";
if (mysqli_query($conn, $sql)) {
    echo "Đã kiểm tra/tạo bảng users.";
} else {
    die('Lỗi tạo bảng: ' . mysqli_error($conn));
}

mysqli_close($conn);
?> 