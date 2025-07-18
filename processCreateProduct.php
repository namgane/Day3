<?php
include 'connectDB.php';
$con = connectDB();

$name = $_POST['name'];
$description = $_POST['description'];
$price= $_POST['price'];   
$stock_quantity = $_POST['stock_quantity'];
$image = $_POST['image'];

$sql = "INSERT INTO product (name, description, price, stock_quantity, image) 
        VALUES ('$name', '$description', '$price', '$stock_quantity', '$image')";

if ($con->query($sql) === TRUE) {
    header("Location: product.php");
} else {
   header("Location: createProduct.php");
}

$con->close();  