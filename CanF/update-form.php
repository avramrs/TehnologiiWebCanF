<?php
session_start();
$user = null;
if (isset($_SESSION['user_data'])) {
    $user = $_SESSION['user_data'];

}
if (!$user) {
    header('Location: Login.php');
}
require_once("db-util.php");

const tableFields = ["product_id","user_id","upload_date","cans_number", "name", "ingredients", "url_image", "packaging", "quantity", "serving", "brand", "shop", "country", "made_in"];

$database=new Db();
//securitate
if(isset($_GET["name"])){
    
}
$productInfo = $database->getProduct($_GET["id"]);

print_r($productInfo);
?>

<!DOCTYPE html>
<html>
<head>
    <title>CanF</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body id="CF-can-upload" class="CF-no-margin CF-lightblue-background-color">
    
    <div id="CF-logo-section" >
        <div class="CF-template-container">
            <a href="./products.php">
                <img src="./img/LogoTW2.png" alt="Logo">
            </a>
        </div>
    </div>

    <div id="CF-content-section" class="CF-template-container">
        <div id="CF-form-container">
            <form id="CF-update-form">
                <label>Cans number:</label><input type="text" name="cans_number" value=<?php echo $productInfo[3];?>><br>
                <label> Image Url:</label><input type="text" name="url_image" value=<?php echo $productInfo[4];?>><br>
                <label> Can name:</label><input type="text" name="name" value=<?php echo $productInfo[5];?>><br>
                <label> Ingredients:</label><input type="text" name="ingredients" value=<?php echo $productInfo[6];?>><br>
                <label> Packaging:</label><input type="text" name="packaging" value=<?php echo $productInfo[7];?>><br>
                <label> Quantity:</label><input type="text" name="quantity" value=<?php echo $productInfo[8];?>><br>
                <label> Servings:</label><input type="text" name="serving" value=<?php echo $productInfo[9];?>><br>
                <label> Brand:</label><input type="text" name="brand" value=<?php echo $productInfo[10];?>><br>
                <label> Shop:</label><input type="text" name="shop" value=<?php echo $productInfo[11];?>><br>
                <label> Country:</label><input type="text" name="country" value=<?php echo $productInfo[12];?>><br>
                <label> Made in:</label><input type="text" name="made_in" value=<?php echo $productInfo[13];?>><br>
                <input id="CF-form-submit" type="submit" name="submit" value="Submit">
            </form>
        </div>
    </div>

</body>
</html>
