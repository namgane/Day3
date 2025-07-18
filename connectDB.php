<?php
const DB_HOST = 'localhost';
const DB_USER = 'root';
const PWD = '';
const DB_NAME = 'demo'; 
function connectDB() {
    $con = new mysqli(DB_HOST, DB_USER, PWD, DB_NAME);
    //check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
        //die() = echo()+exit();
    }
    return $con;
}