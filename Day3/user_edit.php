<?php
include 'user_db.php';
if (!isset($_GET['id'])) { die('Thiếu ID người dùng'); }
$id = (int)$_GET['id'];
$sql = "SELECT * FROM customers WHERE id=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);
if (!$user) { die('Không tìm thấy người dùng'); }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $user['password'];
    $sql = "UPDATE customers SET password=?, email=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssi', $password, $email, $id);
    mysqli_stmt_execute($stmt);
    header('Location: user_index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa người dùng</title>
</head>
<body>
    <h1>Sửa người dùng</h1>
    <form method="post">
        <label>Tên người dùng: <input type="text" value="<?= htmlspecialchars($user['username']) ?>" disabled></label><br>
        <label>Mật khẩu mới: <input type="password" name="password" placeholder="Để trống nếu không đổi"></label><br>
        <label>Email: <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required></label><br>
        <button type="submit">Cập nhật</button>
    </form>
    <a href="user_index.php">Quay lại</a>
</body>
</html> 