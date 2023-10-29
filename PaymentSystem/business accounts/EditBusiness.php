<?php
session_start();
require_once("../connection.php");
$id = (int)$_GET['id'];
$result = mysqli_query($connect, "SELECT name, description, picture, price FROM product WHERE id =" . $id);
$row = mysqli_fetch_array($result);
$_SESSION['picture'] = $row['picture'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['ServiceName']) ? $_POST['ServiceName'] : $row['Company_name'];
    $description = isset($_POST['descr']) ? $_POST['descr'] : $row['descr'];
    if ($_FILES['file']['name']) {
        $picture = $_FILES['file']['name'];
        $target_file = $_SERVER['DOCUMENT_ROOT'] . '/PaymentSystem/images/' . $picture;
        move_uploaded_file($_FILES['file']['tmp_name'], $target_file);
    } else {
        $picture = $row['picture']; // Use the existing picture value
    }
    $price = isset($_POST['price']) ? $_POST['price'] : $row['price'];
    $result2 = mysqli_query($connect, "UPDATE product
    SET name = '$name', description = '$description', picture = '$picture', price = '$price'
    WHERE id = '$id'");

    if ($result2) {
        header("Location: BusinessDashboard.php");
    } 
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style1NewBusiness.css">
</head>
<body>

<form method="POST" action="EditBusiness.php?id=<?= $id ?>" enctype="multipart/form-data">

 
    <div class="row">
        <div class="col-25">
            <label for="ServiceName">Service name</label>
        </div>
        <div class="col-75">
            <input type="text" name="ServiceName" placeholder="Service Name" value="<?php echo $row['name']; ?>" >
        </div>
    </div>

    <div class="row">
        <div class="col-25">
            <label for="descr">Service description</label>
        </div>
        <div class="col-75">
            <textarea name="descr" rows="10" placeholder="Service description"><?php echo $row['description']; ?></textarea>
        </div>
    </div>

    <div class="row">
        <div class="col-25">
            <label for="file">Service Photo</label>
        </div>
        <div class="col-75">
            <img src="../images/<?php echo $_SESSION['picture']; ?>">
            <input type="file" name="file">
        </div>
    </div>

    <div class="row">
        <div class="col-25">
            <label for="price">Service price</label>
        </div>
        <div class="col-75">
            <input type="text" name="price" placeholder="Service price" value="<?php echo $row['price']; ?>">
        </div>
    </div>

    <div class="row">
        <input type="submit" value="Save">
    </div>

</form>

</body>
</html>
