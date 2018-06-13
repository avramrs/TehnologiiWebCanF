<?php
require_once("dbUtil.php");
const tableFields = ["cans_number", "name", "ingredients", "url_image", "packaging", "quantity", "serving", "brand", "shop", "country", "made_in"];
const tableFieldsNumber = 11;
function uploadRoutine($fileName, $fileType)
{
    return isValid($fileName, $fileType);
}

function isValid($fileName, $fileType)
{
    if ($fileType === "xml") {
        return isValidXML($fileName);
    } else {
        return isValidCSV($fileName);
    }
}


function isValidXML($fileName)
{
    libxml_use_internal_errors(true);
    $xmlString = file_get_contents("./uploads/" . $fileName, FILE_USE_INCLUDE_PATH);
    $productsXML = simplexml_load_string($xmlString);

    if ($productsXML === false) {
        $errors = libxml_get_errors();
        libxml_clear_errors();
        return false;
    }
    parseFileXML($productsXML);
    return true;
}
function isValidCSV($fileName)
{

}
function parseFileXML($productsXML)
{
    $database = new Db();
    $productInfo = ["cans_number" => 0, "name" => "", "ingredients" => "", "url_image" => "", "packaging" => "", "quantity" => "", "serving" => "", "brand" => "", "shop" => "", "country" => "", "made_in" => ""];
    // initializing uploadInfo
    if (isset($_SESSION['user_data'])) {
        $user = $_SESSION['user_data'];
    }
    $uid = $database->findUser($user["username"]);
    $currentTime = new DateTime();
    $uploadInfo = ["user_id" => $uid, "upload_date" => $currentTime->format('Y-m-d H:i:s')];
    // parsing xml
    foreach ($productsXML->children() as $product) {
        for ($i = 0; $i < tableFieldsNumber; $i++) {
            if (isset($product->{tableFields[$i]})) {
                $productInfo[tableFields[$i]] = $product->{tableFields[$i]};
            }
        }
        $database->updateProduct($productInfo, $uploadInfo);
    }
}
function parseFileCSV($productsXML)
{
}
?>
