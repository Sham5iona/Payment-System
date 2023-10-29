<?php
require_once("../connection.php");
session_start();
$id = $_GET['id'];
$result = mysqli_query($connect, "DELETE FROM product WHERE id = '$id'");
if($result){
    header("Location: BusinessDashboard.php");
}