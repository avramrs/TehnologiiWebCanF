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
        <div id="CF-form-container">	
        	<h1>Open Food Facts Upload</h1>
			<form id="CF-update-form" method="post" action="off-request.php">
				<label>Can barcode:</label>
				<input type="number" name="bar_code" required>
				<br>
	            <label>Cans number:</label>
	            <input id="product-info" type="number" name="cans_number" required min="0">
	            <br>
	            <input id="CF-form-submit" type="submit" name="submit" value="Upload">
        	</form>
		</div>
    </div>

</body>
</html>