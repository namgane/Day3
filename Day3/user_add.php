<?php
include 'user_db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $sql = "INSERT INTO customers (username, password, email) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sss', $username, $password, $email);
    if (mysqli_stmt_execute($stmt)) {
        header('Location: user_index.php');
        exit;
    } else {
        $error = 'Tên người dùng hoặc email đã tồn tại!';
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm người dùng</title>
</head>
<body>
    <h1>Thêm người dùng mới</h1>
    <?php if (!empty($error)) echo '<p style="color:red">'.$error.'</p>'; ?>
    <form method="post">
        <label>Tên người dùng: <input type="text" name="username" required></label><br>
        <label>Mật khẩu: <input type="password" name="password" required></label><br>
        <label>Email: <input type="email" name="email" required></label><br>
        <button type="submit">Thêm</button>
    </form>
    <a href="user_index.php">Quay lại</a>
</body>
</html> 