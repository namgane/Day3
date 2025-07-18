<?php
include 'user_db.php';
if (!isset($_GET['id'])) { die('Thiếu ID người dùng'); }
$id = (int)$_GET['id'];
$sql = "DELETE FROM customers WHERE id=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
header('Location: user_index.php');
exit;
?> 