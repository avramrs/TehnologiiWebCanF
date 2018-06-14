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
<body class="CF-no-margin">
	<div id="CF-page">
		<div id="CF-products">
			<a id="CF-Logout" href="Logout.php">Logout</a>
			<div id=CF-search-results-text>
				<a class="CF-PDF" href="stocks.pdf" download target="_blank">
					Stock
				</a>
				<!-- <br /> -->
				<a class="CF-PDF" href="upload-page.php">
					Import
				</a>
				<a class="CF-PDF" href="contact.php">
					Contact
				</a>
				<!-- <input type="text" placeholder="Search..."><br />
				<span id="results">Results:</span> -->
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
			<a href="upload-page.php">
				<img id=CF-import-button src="img/Import.png" alt="Logo">
			</a>
		</div>
	</div>
</body>
</html>