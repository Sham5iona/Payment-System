<?php
// The company is already logged in and it's time to show all the content
// which it offers to the users

session_start();
require_once("../connection.php");

?>


<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="styleBusinessDashboard.css">
    <title><?php echo $_SESSION["name"]." Dashboard"?></title>
</head>
<html>
    <body>
        <div class="container">
            <h1 class="header">Welcome <?php echo $_SESSION['name']. ' Company !'; ?></h1>
            <a style="color: blue;" href="NewBusinessForm.html" class="extra_button">New</a>
             <div class="card-container">
                <?php
                $cname = $_SESSION['name'];
                    $query = mysqli_query($connect, "SELECT id, name, description, picture, price FROM product
                    WHERE Company_name = '$cname'");
                    
                    while($row = mysqli_fetch_array($query)) {
                         
                        echo '<div class="card">
                       <div class="extra_buttons">
                      
                        <a style="color:blue;" class="extra_buttons" href="EditBusiness.php?id='.$row['id'].'">Edit</a>
                        
                        <a class="extra_buttons" href="DeleteBusiness.php?id='.$row['id'].'" onclick="return confirm(\'Are you sure?\')">Delete</a>
                        </div>
                        <img src="../images/'. $row['picture']. '" alt="Product Image">
                                <div class="card-content">
                                    <h2>'. $row['name'] . '</h2>
                                    <p>'. $row['description'] . '</p>
                                    <div class="price">'. $row['price'] . ' lv.</div>
                                    
                                    </div>
                            </div>';
                    }
                ?>
            </div>