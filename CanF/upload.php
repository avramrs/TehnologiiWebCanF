<?php
session_start();
$user = null;
if (isset($_SESSION['user_data'])) {
    $user = $_SESSION['user_data'];

}
if (!$user) {
    header('Location: index.php');
}
require_once("upload-util.php");
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
        <div id="CF-upload-text-result">
            <h1>
                <?php echo upload(); ?>
            </h1>  
        </div>
    </div>

</body>
</html>


<?php
function upload()
{
    $target_dir = "./uploads/";

    if (isset($_POST["submit"])) {
        $target_file = $target_dir . basename($_FILES["uploadFile"]["name"]);
        $FileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = filesize($_FILES["uploadFile"]["tmp_name"]);
        if ($check == false) {
            return "Failed to get file size.";
        }
    }
    if (file_exists($target_file)) {
        return "Sorry, file already exists.";
    }
    if ($_FILES["uploadFile"]["size"] > 2000000) {
        return "Sorry, your file is too large.";
    }
    if ($FileType != "xml" && $FileType != "csv") {
        return "Sorry, only XML and CSV files are allowed.";
    }
    if (move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $target_file)) {
        if (uploadRoutine($_FILES["uploadFile"]["name"], $FileType) === false) {
            unlink($target_file);
            return "The " . $FileType . " file is not valid.";
        } else {
            unlink($target_file);
            return "The file " . basename($_FILES["uploadFile"]["name"]) . " has been uploaded.";
        }
    } else {
        return "Sorry, there was an error uploading your file.";
    }
}
?>