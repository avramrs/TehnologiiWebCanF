<?php
	session_start();
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

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){ 

		    var auto= $('#CF-ajax-content'), refreshed_content;	
				refreshed_content = setInterval(function(){
				auto.load("products-reload.php");},
				1000);
				console.log(refreshed_content);										 
				return false; 
		});
	</script>
</head>
<body id="CF-products-page" class="CF-no-margin">
	<div id="CF-page">
		<div id="CF-products">
			<div id="CF-download-buttons">
				<a class="CF-PDF" href="stocks-generator.php">
					Stock
				</a>
				<a class="CF-PDF" href="upload-page.php">
					Import
				</a>
				<a class="CF-PDF" href="contact.php">
					Contact
				</a>
			</div>

			<!-- PHP -->
			<div id="CF-search-results">
				<div id="CF-ajax-content"> </div> 
			</div>

		</div>
	</div>
	<div id="CF-title-section" >
		<div class="CF-container">
			<a href="products.php">
				<img src="img/LogoTW2.png" alt="Logo">
			</a>
			<a id="CF-import-button" href="Logout.php">Logout</a>
		</div>
	</div>
</body>
</html>