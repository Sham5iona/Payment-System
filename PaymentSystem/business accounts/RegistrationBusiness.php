<?php
require_once("../connection.php");

$name = $_POST["Company_name"];

$email = $_POST["email"];

$password = md5($_POST["password"]);

    $result = mysqli_query($connect, "INSERT INTO Companies(name, email, password)
    VALUES('$name', '$email', '$password');
");

if($result){
    header("Location: BusinessForm.html");
    
}
