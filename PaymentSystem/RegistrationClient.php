<?php
require_once("connection.php");

$fname = $_POST["firstname"];

$lname = $_POST["lastname"];

$email = $_POST["email"];

$password = md5($_POST["password"]);

$result = mysqli_query($connect, "INSERT INTO Users (firstname, lastname, email, password)
VALUES ('$fname', '$lname', '$email', '$password')
");

if($result){
    echo "<script>alert('Successfully signed up!');</script>";
    header("Location: index.html");
}
