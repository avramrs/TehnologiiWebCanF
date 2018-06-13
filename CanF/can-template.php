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
<body id="CF-can-template" class="CF-no-margin CF-lightblue-background-color">

	<div id="CF-logo-section" >
		<div class="CF-template-container">
			<a href="Products.html">
				<img src="img/LogoTW2.png" alt="Logo">
			</a>
		</div>
	</div>

	<div id="CF-content-section" class="CF-template-container">
		<div id="CF-can-image">
			<img src="img/can2.jpg" alt="can image">
		</div>

		<div id="CF-can-details">
			<div class="CF-center-aligned-text CF-helvetica-font CF-darkblue-color">
				<h1>Sliced Carrots</h1>
			</div>

			<div class="CF-can-details-table">
				<table>
					<tr>
						<th>Ingredients:</th>
						<th>carrots, water, ascorbic acid</th>
					</tr>
					<tr>
						<th>Allergens and other substances:</th>
						<th>unknown</th>
					</tr>
					<tr>
						<th>Packaging method:</th>
						<th>metal can</th>
					</tr>
					<tr>
						<th>Quantity:</th>
						<th>160g</th>
					</tr>
					<tr>
						<th>Brands:</th>
						<th>Tesco</th>
					</tr>
					<tr>
						<th>Manufacturing or processing places:</th>
						<th>Italy</th>
					</tr>
					<tr>
						<th>Stores:</th>
						<th>Tesco</th>
					</tr>
					<tr>
						<th>Countries where sold:</th>
						<th>United Kingdom</th>
					</tr>
				</table>
			</div>
		</div>
		<div id="CF-download-buttons" class="CF-center-aligned-text">
			<a download href="can-template.html">
  				Download .csv
			</a>
			<a download href="can-template.html">
  				Download .xml
			</a>
		</div>
	</div>

</body>
</html>