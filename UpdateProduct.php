<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h1 class="mb-4">Update Product</h1>

    <?php
    include 'connectDb.php';
    $conn = connectDb();

    // Lấy ID sản phẩm từ URL
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    if ($id <= 0) {
        echo '<div class="alert alert-danger">Invalid ID provided.</div>';
        exit;
    }

    // Truy vấn thông tin sản phẩm
    $sql = "SELECT id, name, price, stock_quantity, image FROM product WHERE id = $id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
    ?>

    <!-- Form cập nhật sản phẩm -->
    <form action="processUpdateProduct.php" method="POST" class="bg-white p-4 rounded shadow-sm">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>

        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" name="name" id="name" class="form-control"
                   value="<?php echo htmlspecialchars($row['name']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price ($)</label>
            <input type="number" step="0.01" name="price" id="price" class="form-control"
                   value="<?php echo htmlspecialchars($row['price']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4" required>
                <?php echo htmlspecialchars($row['description']); ?></textarea>
        </div>


        <div class="mb-3">
            <label for="stock_quantity" class="form-label">Stock Quantity</label>
            <input type="number" name="stock_quantity" id="stock_quantity" class="form-control"
                   value="<?php echo htmlspecialchars($row['stock_quantity']); ?>" required>    
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image URL</label>
            <input type="text" name="image" id="image" class="form-control"
                   value="<?php echo htmlspecialchars($row['image']); ?>" required>
        </div>

        <div class="d-grid">
            <input type="submit" value="Update Product" class="btn btn-warning">
        </div>
    </form>

    <?php
        $result->free_result();
    } else {
        echo '<div class="alert alert-danger">❌ Product not found with ID = ' . $id . '</div>';
    }

    $conn->close();
    ?>
</div>

</body>
</html>
