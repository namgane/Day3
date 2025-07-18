<?php
include 'db.php';

// Lấy danh sách sản phẩm
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý sản phẩm</title>
    <style>
        table, th, td { border: 1px solid #333; border-collapse: collapse; padding: 8px; }
        img { max-width: 100px; }
    </style>
</head>
<body>
    <h1>Danh sách sản phẩm</h1>
    <a href="add.php">Thêm sản phẩm</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Giá</th>
            <th>Số lượng tồn kho</th>
            <th>Hình ảnh</th>
            <th>Hành động</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= $row['price'] ?></td>
            <td><?= $row['stock_quantity'] ?></td>
            <td><?php if ($row['image']): ?><img src="uploads/<?= htmlspecialchars($row['image']) ?>" alt="Ảnh"><?php endif; ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id'] ?>">Sửa</a> |
                <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
<?php mysqli_close($conn); ?> 