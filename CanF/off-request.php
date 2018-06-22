<?php session_start();
$user = null;
if(isset($_SESSION['user_data']))
{
	$user = $_SESSION['user_data'];

}
if(!$user)
{
	header('Location: index.php');
}

// Default parameters by case
$country = 'en'; // Country by using OFF
$productSlug = 'product'; // Product by language (producto in spanish or product in english)

// Format URL
$url = 'https://{country}.openfoodfacts.org/api/v0/{product}/{scan}.json';

// Where we will set the value of the scan
if(isset($_POST['bar_code'])) {
	$barcode = strip_tags(trim($_POST['bar_code']));
} else {
	header('Location: index.php');
}
if(isset($_POST['cans_number'])) {
	$cans_number = strip_tags(trim($_POST['cans_number']));
} else {
	header('Location: index.php');
}

$url = str_replace(['{country}','{product}','{scan}'],[$country,$productSlug,$barcode],$url);

// Connection to the API (french version here)
$result = file_get_contents($url);
// Decoding the JSON into an usable array (the value "true" confirms that the return is only an array)
$json = json_decode($result, true);
if($json['status'] == 1) {
	// Get the datas we want
	// $currentTime = new DateTime();
	// $upload_date = $currentTime->format('Y-m-d H:i:s');
	$image = $json['product']['image_small_url'];
	$productName = $json['product']['product_name'];
	$productName = addslashes(strip_tags(preg_replace("/\([^)]+\)/","", preg_replace('/\[[^\]]*\]\W*/i', '', $productName))));
	$ingredients = $json['product']['ingredients_text'];
	$ingredients = addslashes(strip_tags(str_replace('_', ' ', preg_replace('/\[[^\]]*\]\W*/i', '', $ingredients))));
	$packaging = $json['product']['packaging'];
	$packaging = addslashes(strip_tags(preg_replace("/\([^)]+\)/","", preg_replace('/\[[^\]]*\]\W*/i', '', $packaging))));
	$quantity = $json['product']['quantity'];
	// $serving = $json['product']['serving_quantity'];
	$brand = $json['product']['brands'];
	$brand = addslashes(strip_tags(preg_replace("/\([^)]+\)/","", preg_replace('/\[[^\]]*\]\W*/i', '', $brand))));
	$stores = $json['product']['stores'];
	$stores = addslashes(strip_tags(preg_replace("/\([^)]+\)/","", preg_replace('/\[[^\]]*\]\W*/i', '', $stores))));
	$sold = $json['product']['purchase_places'];
	$sold = addslashes(strip_tags(preg_replace("/\([^)]+\)/","", preg_replace('/\[[^\]]*\]\W*/i', '', $sold))));
	$manufacture = $json['product']['manufacturing_places'];
	$manufacture = addslashes(strip_tags(preg_replace("/\([^)]+\)/","", preg_replace('/\[[^\]]*\]\W*/i', '', $manufacture))));

	$mysql = new mysqli ('localhost', 'root',	'',	'TWProject');
	if (mysqli_connect_errno()) {
		die ('Conexiunea a esuat...');
	}

	$sql = "INSERT INTO products (user_id, upload_date, cans_number, url_image, name, ingredients, packaging, quantity, brand, shop, country, made_in) VALUES (" . $_SESSION['user_data']['id'] . ", now(), " . $cans_number . ", '" . $image . "', '" . $productName . "', '" . $ingredients . "', '" . $packaging . "', '" . $quantity . "', '" . $brand . "', '" . $stores . "', '" . $sold . "', '" . $manufacture . "')";	

	

	if ($mysql->query($sql) === TRUE) {
	    echo "<br>New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $mysql->error;
	}

	$mysql->close();
	header('Location: products.php');

} else { ?>
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
	            <a id="CF-import-button" href="Logout.php">Logout</a>
	        </div>
	    </div>

	    <div id="CF-content-section" class="CF-template-container">
	        <div id="CF-upload-text-result">
	            <h1>
	                <?php echo "No such product exists"; ?>
	            </h1>  
	        </div>
	    </div>

	</body>
	</html>
<?php
}
?>

