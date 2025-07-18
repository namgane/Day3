<?php
include 'connectDB.php';
$con = connectDB();

// Kiểm tra nếu có đủ thông tin được gửi
if (isset($_GET['id'], $_POST['email'], $_POST['password'], $_POST['confirm'], $_POST['fullname'], $_POST['phone'])) {

    $id = intval($_GET['id']); // ép kiểu cho an toàn
    $email = trim($_POST['email']);
    $pwd = $_POST['password'];
    $confirm = $_POST['confirm'];
    $fullname = trim($_POST['fullname']);
    $phone = trim($_POST['phone']);

    // Kiểm tra xác nhận mật khẩu
    if ($pwd !== $confirm) {
        echo "⚠️ Mật khẩu và xác nhận không khớp.";
        exit;
    }

    // Mã hóa mật khẩu nếu cần (tuỳ hệ thống, nên dùng)
    // $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    // Dùng Prepared Statement để tránh SQL Injection
    $stmt = $con->prepare("UPDATE accounts SET email = ?, password = ?, fullname = ?, phone = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $email, $pwd, $fullname, $phone, $id);

    if ($stmt->execute()) {
        header("Location: viewAccount.php");
        exit;
    } else {
        echo "❌ Lỗi khi cập nhật: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "⚠️ Thiếu thông tin cần thiết để cập nhật.";
}

$con->close();
?>
