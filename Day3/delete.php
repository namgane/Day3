<?php
include 'db.php';
if (!isset($_GET['id'])) { die('Thiếu ID sản phẩm'); }
$id = (int)$_GET['id'];
$sql = "DELETE FROM products WHERE id=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
header('Location: index.php');
exit;
?> 