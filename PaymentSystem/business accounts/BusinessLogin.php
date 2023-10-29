<?php
//File for checking if company exists in database
//if so, create sessions, if not, gives an error message

session_start();
require_once("../connection.php");

$name = $_POST["Company_name"];

$email = $_POST["email"];

$password = md5($_POST["password"]);

$result = mysqli_query($connect, "SELECT name FROM Companies cu
          WHERE cu.name = '$name'
          AND cu.email = '$email'
          AND cu.password = '$password'"
);

$row = mysqli_fetch_array($result);

if(isset($row)){

$_SESSION['name'] = $row['name'];

header("Location: BusinessDashboard.php"); // Redirect to dashboard for successful login
exit();

} else {

    echo "<h2 style='color:red'>Invalid Company name / email or password. Please try again.</h2>";
   
}

mysqli_close($connect);
