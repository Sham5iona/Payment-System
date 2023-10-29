<?php
// The user is already logged in and it's time to show all the content
// which dealers offers to the user
session_start();
require_once("connection.php");

?>

<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="style2Dashboard.css">
    <title><?php echo $_SESSION["firstname"]." ". $_SESSION["lastname"]." Dashboard"?></title>
</head>
<html>
    <body>
        <div class="container">
            <h1 class="header">Welcome <?php echo $_SESSION['firstname']." ". $_SESSION['lastname']. '!'; ?></h1>

                <input type="text" id="search" name="search" placeholder="Search..." onkeyup="filterItems()">
                <h1 id="exception" style="display: none">No matching records found.</h1>
            <script>
                function filterItems() { //Filter the search input
                    let searchTerm = document.getElementById("search").value.toLowerCase();
                    let items = document.getElementsByClassName("card");
                    let match_found = false;
                    let element =  document.getElementById("exception").style;
                    for (let i = 0; i < items.length; i++) {
                        let itemName = items[i].querySelector(".card-content h1").textContent.toLowerCase();
                        if (itemName.includes(searchTerm)) {
                            match_found = true;
                            document.getElementById("exception").style.display = "none";
                            items[i].style.display = "block";
                            
                        } else {
                            items[i].style.display = "none";

                        }
                        element.display = match_found ? "none" : "block";
                        element.color = match_found ? "" : "red";
                    }
                }
            </script>
            
            <div class="card-container">
                <?php
                    $query = mysqli_query($connect, "SELECT Company_name, name, description, picture, price FROM product");
                    while($row = mysqli_fetch_array($query)) {
                        echo '<div class="card">
                                <img src="images/'. $row['picture']. '" alt="Product Image">
                                <div class="card-content">
                                <h1>'. $row['name'] . '</h1>
                                <h2>Company name is '.$row["Company_name"].'</h2>
                                    
                                    <p>'. $row['description'] . '</p>
                                    <div class="price">'. $row['price'] . ' lv.</div>
                                    <a href="https://buy.stripe.com/test_7sIbMHdT20RQ0CcbIK" name="buy">Buy now</a><br><br><br>
                                    <a style="color:blue;" href="https://nowpayments.io/payment/?iid=5184895936">Buy now with Cryptocurrency</a>
                                    </div>
                            </div>';
                    }
                ?>
            </div>
        </div>
    </body>
</html>
