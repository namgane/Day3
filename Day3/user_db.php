<?php
// Kết nối MySQL cho ex03
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'ex03';

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die('Kết nối thất bại: ' . mysqli_connect_error());
}
?> 