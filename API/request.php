<?php

// Default parameters by case
$country = 'en'; // Country by using OFF
$productSlug = 'product'; // Product by language (producto in spanish or product in english)

// Format URL
$url = 'https://{country}.openfoodfacts.org/api/v0/{product}/{scan}.json';

// Where we will set the value of the scan
$barcode = (int) $_GET['ean13'];

$url = str_replace(['{country}','{product}','{scan}'],[$country,$productSlug,$barcode],$url);

// Connection to the API (french version here)
$result = file_get_contents($url);

// Decoding the JSON into an usable array (the value "true" confirms that the return is only an array)
$json = json_decode($result, true);

// Get the datas we want
$productName = $json['product']['product_name'];
$brand = $json['product']['brands'];
$image = $json['product']['image_small_url'];
$ingredients = $json['product']['ingredients_text'];
$packaging = $json['product']['packaging'];
$quantity = $json['product']['product_quantity'];
$serving = $json['product']['serving_quantity'];
$sold = $json['product']['purchase_places'];
$manufacture = $json['product']['manufacturing_places'];
$stores = $json['product']['stores'];

$viewData = file_get_contents('response.php');

echo str_replace(
    ['{productName}','{brand}','{image}','{ingredients}','{serving}','{sold}','{stores}','{manufacture}','{quantity}','{package}','{json}'],
    [$productName,$brand,$image,$ingredients,$serving,$sold,$stores,$manufacture,$quantity,$packaging,print_r($json,true)],
    $viewData);
?>