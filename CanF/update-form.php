<?php
session_start();
$user = null;
if (isset($_SESSION['user_data'])) {
    $user = $_SESSION['user_data'];

}
if (!$user) {
    header('Location: index.php');
}
require_once("db-util.php");

const tableFields = ["product_id", "user_id", "upload_date", "cans_number", "name", "ingredients", "url_image", "packaging", "quantity", "serving", "brand", "shop", "country", "made_in"];

$database = new Db();
$productInfo = $database->getProduct($_GET["id"]);
if (!((strcmp($_SESSION['user_data']['username'], 'admin') === 0) || ($_SESSION['user_data']['id'] == $productInfo[1]))) {
    header('Location: index.php');
}

    // $cans_number = $url_image = $name = $ingredients = $packaging = $quantity = $serving = $brand = $shop = $country = $made_in = "";
    // $cans_number =;
    // $url_image =;
    // $name =;
    // $ingredients =;
    // $packaging =;
    // $quantity =;
    // $serving =;
    // $brand =;
    // $shop =;
    // $country =;
    // $made_in =;

$nameErr = "";
$urlErr = "";
$success = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(testInput($_POST["name"]))) {
        $nameErr = "You must enter a name";
    } else {
        $name = testInput($_POST["name"]);
    }
    if (empty($_POST["url_image"])) {
        $urlErr = "Image url can't be empty";
    } else {
        $url_image = testInput($_POST["url_image"]);
        $url_image = filter_var($url_image, FILTER_SANITIZE_URL);
        if (filter_var($url_image, FILTER_VALIDATE_URL) === false) {
            $urlErr = "Invalid URL";
        }
    }
    if (empty($nameErr) && empty($urlErr)) {
        $updateInfo = array();
        $currentTime = new DateTime();
        $cans_number = testInput($_POST["cans_number"]);
        $ingredients = testInput($_POST["ingredients"]);
        $packaging = testInput($_POST["packaging"]);
        $quantity = testInput($_POST["quantity"]);
        $serving = testInput($_POST["serving"]);
        $brand = testInput($_POST["brand"]);
        $shop = testInput($_POST["shop"]);
        $country = testInput($_POST["country"]);
        $made_in = testInput($_POST["made_in"]);
        $upload_date = $currentTime->format('Y-m-d H:i:s');
        $updateInfo["product_id"] = $productInfo[0];
        $updateInfo["user_id"] = $productInfo[1];
        for ($i = 2; $i < count(tableFields); $i++) {
            $updateInfo[tableFields[$i]] = ${tableFields[$i]};
        }
        $database->updateProductByID($updateInfo);
        $success = "Success!";
    }
    print_r($updateInfo);
}

//print_r($productInfo);
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
            <h1>Product update form:</h1>
            <form id="CF-update-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $_GET["id"]; ?>">
                <label>Cans number:</label><input id="product-info" type="text" name="cans_number" value=<?php echo testInput($productInfo[3]); ?>><br>
                <label> Image Url:<span id="form-error"><?php echo $urlErr ?></span></label><input id="product-info" type="text" name="url_image" value=<?php echo testInput($productInfo[4]); ?>><br>
                <label> Can name:<span id="form-error"><?php echo $nameErr ?></span></label><input id="product-info" type="text" name="name" value=<?php echo testInput($productInfo[5]); ?>><br>
                <label> Ingredients:</label><input id="product-info" type="text" name="ingredients" value=<?php echo testInput($productInfo[6]); ?>><br>
                <label> Packaging:</label><input id="product-info" type="text" name="packaging" value=<?php echo testInput($productInfo[7]); ?>><br>
                <label> Quantity:</label><input id="product-info" type="text" name="quantity" value=<?php echo testInput($productInfo[8]); ?>><br>
                <label> Servings:</label><input id="product-info" type="text" name="serving" value=<?php echo testInput($productInfo[9]); ?>><br>
                <label> Brand:</label><input id="product-info" type="text" name="brand" value=<?php echo testInput($productInfo[10]); ?>><br>
                <label> Shop:</label><input id="product-info" type="text" name="shop" value=<?php echo testInput($productInfo[11]); ?>><br>
                <label> Country:</label><input id="product-info" type="text" name="country" value=<?php echo testInput($productInfo[12]); ?>><br>
                <label> Made in:</label><input id="product-info" type="text" name="made_in" value=<?php echo testInput($productInfo[13]); ?>><br>
                <h3 id="form-success"><?php echo $success ?></h3>
                <input id="CF-form-submit" type="submit" name="submit" value="Submit">
            </form>
        </div>
    </div>
</body>
</html>

<?php
function testInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function checkImageUrl($url_image)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url_image);
    curl_setopt($ch, CURLOPT_NOBODY, 1);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($ch);
    curl_close($ch);
    if ($result !== false) {
        return true;
    }
    return false;
}
?>
