<?php
//File for checking if user exists in database
//if so, create sessions, if not, gives an error message

session_start();
require_once("connection.php");

$fname = $_POST["firstname"];

$lname = $_POST["lastname"];

$email = $_POST["email"];

$password = md5($_POST["password"]);

$result = mysqli_query($connect, "SELECT firstname, lastname FROM Users u
          WHERE u.firstname = '$fname'
          AND u.lastname = '$lname'
          AND u.email = '$email'
          AND u.password = '$password'"
);

$row = mysqli_fetch_array($result);

if(isset($row)){

$_SESSION['firstname'] = $row['firstname'];
$_SESSION['lastname'] = $row['lastname'];

header("Location: dashboard.php"); // Redirect to dashboard for successful login
exit();

} else {

    echo "<h2 style='color:red'>Invalid firstname / lastname / email or password. Please try again.</h2>";
   
}

mysqli_close($connect);
