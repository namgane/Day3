 <h1> Update Account</h1>
    <?php
    include 'connectDB.php';

    $con = connectDB();
    $id = $_GET['id'];

    $sql = "Delete FROM account WHERE id=$id";
    if ($con->query($sql) === TRUE) {
        header("Location: account.php");
    } else {
        header("Location: account.php");
    }
    $con->close();
    