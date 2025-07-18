<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <h1 class="mb-4">Update Account</h1>

        <?php
        include 'connectDb.php';
        $conn = connectDb();

        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if ($id <= 0) {
            echo '<div class="alert alert-danger">Invalid ID provided.</div>';
            exit;
        }

        $sql = "SELECT id, email, fullname, phone FROM account WHERE id=$id";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
        ?>

        <form action="processUpdate.php" method="POST" class="bg-white p-4 rounded shadow-sm">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" id="email" class="form-control" value="<?php echo htmlspecialchars($row['email']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="fullname" class="form-label">Full Name</label>
                <input type="text" name="fullname" id="fullname" class="form-control" value="<?php echo htmlspecialchars($row['fullname']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control" value="<?php echo htmlspecialchars($row['phone']); ?>" required>
            </div>

            <div class="d-grid">
                <input type="submit" value="Update Account" class="btn btn-warning">
            </div>
        </form>

        <?php
            $result->free_result();
        } else {
            echo '<div class="alert alert-danger">Account not found with ID = ' . $id . '</div>';
        }

        $conn->close();
        ?>
    </div>

</body>
</html>
