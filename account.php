<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <form method="GET" action="" class="me-3 w-50">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" id="email" class="form-control" placeholder="Search by email" value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>">
                <input type="submit" value="Search" class="btn btn-primary mt-2">
            </form>

            <div>
                <h1 class="h3 mb-3">Account List</h1>
                <a href="createAcount.php" class="btn btn-success">+ Create New</a>
            </div>
        </div>

        <table class="table table-bordered table-hover bg-white">
            <thead class="table-dark">
                <tr>
                    <th>Id</th>
                    <th>Email</th>
                    <th>Full Name</th>
                    <th>Phone</th>
                    <th style="width: 150px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'connectDB.php';
                $con = connectDB();

                $sql = "SELECT id, email, fullname, phone FROM Customer";

                if (isset($_GET['email']) && trim($_GET['email']) !== '') {
                    $email = $con->real_escape_string(trim($_GET['email']));
                    $sql .= " WHERE email LIKE '%$email%'";
                }

                $result = $con->query($sql);
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_array(MYSQLI_NUM)) {
                        echo "<tr>
                            <td>$row[0]</td>
                            <td>$row[1]</td>
                            <td>$row[2]</td>
                            <td>$row[3]</td>
                            <td>
                                <a href='UpdateAccount.php?id=$row[0]' class='btn btn-sm btn-warning'>Update</a>
                                <a href='DeleteAccount.php?id=$row[0]' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                            </td>
                        </tr>";
                    }
                    $result->free_result();
                } else {
                    echo "<tr>
                        <td colspan='5' class='text-center text-danger'>Không tìm thấy tài khoản nào với từ khóa trên.</td>
                    </tr>";
                }

                $con->close();
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>
