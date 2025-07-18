 <h1> Update Account</h1>
    <?php
    include 'connectDB.php';

    $con = connectDB();
    $id = $_GET['id'];

    $sql = "Delete FROM product WHERE id=$id";
    if ($con->query($sql) === TRUE) {
        header("Location: product.php");
    } else {
        header("Location: product.php");
    }
    $con->close();
    