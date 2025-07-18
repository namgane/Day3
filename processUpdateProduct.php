<?php
include 'connectDB.php';
$con = connectDB();
$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$price= $_POST['price'];   
$stock_quantity = $_POST['stock_quantity'];
$image = $_POST['image'];

$sql = "UPDATE product 
        SET name = '$name',
            description = '$description',
            price = '$price',
            stock_quantity = '$stock_quantity',
            image = '$image'
        WHERE id = $id";
        

if ($con->query($sql) === TRUE) {
    header("Location: product.php");
} else {
   header("Location: UpdateProduct.php");
}

$con->close();  