<?php
require_once("db-util.php");
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
    } else if ($fileType === "csv"){
        return isValidCSV($fileName);
    }
}


function isValidXML($fileName)
{
    if (!file_exists("./uploads/" . $fileName) || !is_readable("./uploads/" . $fileName)) {
        return false;
    }
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

function parseFileXML($productsXML)
{
    $database = new Db();
    // initializing uploadInfo
    $uploadInfo = getUploadInfo();
    // parsing xml
    foreach ($productsXML->children() as $product) {
        $productInfo = ["cans_number" => 0, "name" => "", "ingredients" => "", "url_image" => "", "packaging" => "", "quantity" => "", "serving" => "", "brand" => "", "shop" => "", "country" => "", "made_in" => ""];
        for ($i = 0; $i < tableFieldsNumber; $i++) {
            if (isset($product->{tableFields[$i]})) {
                $productInfo[tableFields[$i]] = $product->{tableFields[$i]};
            }
        }
        $database->updateProduct($productInfo, $uploadInfo);
    }
}
function isValidCSV($fileName)
{
    if (!file_exists("./uploads/" . $fileName) || !is_readable("./uploads/" . $fileName)) {
        return false;
    }
    $data = array();
    if (($handle = fopen("./uploads/" . $fileName, 'r')) !== false) {
        $header = fgetcsv($handle, 1000);
        $columnNumber = count($header);
        while (($row = fgetcsv($handle, 1000)) !== false) {
            if(count($row) !== $columnNumber){
                return false;
            }
            $data[] = array_combine($header, $row);
        }
        fclose($handle);
    } else {
        return false;
    }
    $requiredHeader = array();
    for ($i = 0; $i < tableFieldsNumber; $i++) {
        $position = array_search(tableFields[$i], $header);
        if ($position !== false) {
            $requiredHeader[] = $header[$position];
        }
    }
    if (array_search("name", $requiredHeader) === false) {
        return false;
    }
    if(parseFileCSV($data, $requiredHeader)===false){
        return false;
    }
    return true;
}

// receives data = an array of arrays indexed by the csv header representing rows
// and header = the columns that can be inserted into the table
function parseFileCSV($data, $header)
{
    $rowNumber = count($data);
    $columnNumber = count($header);
    $uploadInfo = getUploadInfo();
    $database = new Db();
    for ($i = 0; $i < $rowNumber; $i++) {
        $productInfo = ["cans_number" => 0, "name" => "", "ingredients" => "", "url_image" => "", "packaging" => "", "quantity" => "", "serving" => "", "brand" => "", "shop" => "", "country" => "", "made_in" => ""];
        for ($j = 0; $j < $columnNumber; $j++) {
            $productInfo[$header[$j]] = $data[$i][$header[$j]];
        }
        if(isInteger($productInfo["cans_number"])===false){
            return false;
        }
        $database->updateProduct($productInfo, $uploadInfo);
    }
}
function isInteger($input){
    return(ctype_digit(strval($input)));
}
function getUploadInfo()
{
    if (isset($_SESSION['user_data'])) {
        $user = $_SESSION['user_data'];
    }
    $database = new Db();
    $uid = $user["id"];
    $currentTime = new DateTime();
    $uploadInfo = ["user_id" => $uid, "upload_date" => $currentTime->format('Y-m-d H:i:s')];
    return $uploadInfo;
}
?>
