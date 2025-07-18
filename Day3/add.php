<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) mkdir($uploadDir);
        $image = basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $image);
    }
    $sql = "INSERT INTO products (name, price, stock_quantity, image) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sdis', $name, $price, $quantity, $image);
    mysqli_stmt_execute($stmt);
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm sản phẩm</title>
</head>
<body>
    <h1>Thêm sản phẩm mới</h1>
    <form method="post" enctype="multipart/form-data">
        <label>Tên: <input type="text" name="name" required></label><br>
        <label>Giá: <input type="number" step="0.01" name="price" required></label><br>
        <label>Số lượng tồn kho: <input type="number" name="quantity" required></label><br>
        <label>Hình ảnh: <input type="file" name="image"></label><br>
        <button type="submit">Thêm</button>
    </form>
    <a href="index.php">Quay lại</a>
</body>
</html> 