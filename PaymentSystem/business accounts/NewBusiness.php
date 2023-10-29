<?php

require_once("../connection.php");
session_start();

$name = isset($_POST['ServiceName']) ? $_POST['ServiceName'] : '';
$description = isset($_POST['descr']) ? $_POST['descr'] : '';
$file = $_FILES['file']['name'];
$price = isset($_POST['price']) ? $_POST['price'] : '0.0';
$company_name = $_SESSION['name'];
$target_file = $_SERVER['DOCUMENT_ROOT'].'/PaymentSystem/images/'.$file;

move_uploaded_file($_FILES['file']['tmp_name'], $target_file);

$result = mysqli_query($connect, "INSERT INTO product (name, description, picture, price, Company_name) 
VALUES ('$name', '$description', '$file', '$price', '$company_name')");

if($result){
    header("Location: BusinessDashboard.php");
}

