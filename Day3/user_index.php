<?php
include 'user_db.php';
// Lấy danh sách người dùng
$sql = "SELECT id, username, email FROM customers";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý người dùng</title>
    <style>
        table, th, td { border: 1px solid #333; border-collapse: collapse; padding: 8px; }
    </style>
</head>
<body>
    <h1>Danh sách người dùng</h1>
    <a href="user_add.php">Thêm người dùng</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Tên người dùng</th>
            <th>Email</th>
            <th>Hành động</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['username']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td>
                <a href="user_edit.php?id=<?= $row['id'] ?>">Sửa</a> |
                <a href="user_delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
<?php mysqli_close($conn); ?> 