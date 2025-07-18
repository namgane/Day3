<?php
include 'connectDB.php';
$con = connectDB();

$email = $_POST['email'];
$pwd = $_POST['password'];
$confirm = $_POST['confirm'];   
$fullname = $_POST['fullname'];
$phone = $_POST['phone'];

$sql = "INSERT INTO account (email, password, fullname, phone) 
        VALUES ('$email', '$pwd', '$fullname', '$phone')";

if ($con->query($sql) === TRUE) {
    header("Location: account.php");
} else {
   header("Location: createAcount.php");
}

$con->close();  