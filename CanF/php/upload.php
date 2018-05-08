<!DOCTYPE html>
<html>
<head>
    <title>CanF</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body id="CF-can-upload" class="CF-no-margin CF-lightblue-background-color">
    
    <div id="CF-logo-section" >
        <div class="CF-template-container">
            <a href="../Products.html">
                <img src="../img/LogoTW2.png" alt="Logo">
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
function upload(){
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["uploadFile"]["name"]);
    $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = filesize($_FILES["uploadFile"]["tmp_name"]);
        if($check == false) {
            return "Failed to get file size.";
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        return "Sorry, file already exists.";
    }
    // Check file size
    if ($_FILES["uploadFile"]["size"] > 2000000) {
        return "Sorry, your file is too large.";
    }
    // Allow certain file formats
    if($FileType != "xml" && $FileType != "csv") {
        return "Sorry, only XML and CSV files are allowed.";
    }
    if (move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $target_file)) {
        return "The file ". basename( $_FILES["uploadFile"]["name"]). " has been uploaded.";
    } else {
        return "Sorry, there was an error uploading your file.";
    }
}
?>