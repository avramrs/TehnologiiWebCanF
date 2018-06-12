<?php
session_start();
$user = null;
if(isset($_SESSION['user_data']))
{
	$user = $_SESSION['user_data'];

}
if(!$user)
{
	header('Location: Login.php');
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
			<a href="Products.html">
				<img src="img/LogoTW2.png" alt="Logo">
			</a>
		</div>
	</div>

	<div id="CF-content-section" class="CF-template-container">
		<div id="CF-upload-text">
			<h1>Upload your<br>.csv file here:</h1>	
		</div>
		<div id="CF-upload-button">
			<label for="CF-file-upload">
    			Upload
			</label>
			<input id="CF-file-upload" type="file"/>
		</div>
	</div>

</body>
</html>