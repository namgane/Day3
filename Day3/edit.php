<?php
include 'db.php';
if (!isset($_GET['id'])) { die('Thiếu ID sản phẩm'); }
$id = (int)$_GET['id'];
$sql = "SELECT * FROM products WHERE id=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$product = mysqli_fetch_assoc($result);
if (!$product) { die('Không tìm thấy sản phẩm'); }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $image = $product['image'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) mkdir($uploadDir);
        $image = basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $image);
    }
    $sql = "UPDATE products SET name=?, price=?, stock_quantity=?, image=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sdisi', $name, $price, $quantity, $image, $id);
    mysqli_stmt_execute($stmt);
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa sản phẩm</title>
</head>
<body>
    <h1>Sửa sản phẩm</h1>
    <form method="post" enctype="multipart/form-data">
        <label>Tên: <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required></label><br>
        <label>Giá: <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>" required></label><br>
        <label>Số lượng tồn kho: <input type="number" name="quantity" value="<?= $product['quantity'] ?>" required></label><br>
        <label>Hình ảnh: <input type="file" name="image"></label>
        <?php if ($product['image']): ?><br><img src="uploads/<?= htmlspecialchars($product['image']) ?>" style="max-width:100px"><?php endif; ?><br>
        <button type="submit">Cập nhật</button>
    </form>
    <a href="index.php">Quay lại</a>
</body>
</html> 