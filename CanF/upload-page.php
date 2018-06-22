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
?>
<!DOCTYPE html>
<html>
<head>
	<title>CanF</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body id="CF-can-upload" class="CF-no-margin CF-lightblue-background-color">
	
	<div id="CF-logo-section" >
		<div class="CF-template-container">
			<a href="./products.php">
				<img src="img/LogoTW2.png" alt="Logo">
			</a>
			<a id="CF-import-button" href="Logout.php">Logout</a>
		</div>
	</div>

	<div id="CF-content-section" class="CF-template-container">
		<div class="CF-upload-text">
			<h1>Upload your<br>csv/xml file here:</h1>	
		</div>
		<form class="CF-upload-button" 
		action="upload.php"
		method="post"
		enctype="multipart/form-data">
			<label for="CF-file-browse">
				Choose File
			</label>
			<label for="CF-file-upload">
    			Upload
			</label>
			<input id="CF-file-browse" type="file" name="uploadFile">
			<input id="CF-file-upload" type="submit" name="submit"/>
		</form>
		<div class="CF-upload-text" style="margin-top: 0">
			<h1>Upload from<br>Open Food Facts:</h1>	
		</div>
		<div id="CF-download-buttons" class="CF-upload-button" style="margin-top: 4px">
			<a href="off-upload.php" style="text-align: center; background-color: #ffac33">
				Upload
			</a>
		</div>
	</div>

</body>
</html>