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
	<script>
	function showContent() {
	        if (window.XMLHttpRequest) {
	            // code for IE7+, Firefox, Chrome, Opera, Safari
	            xmlhttp = new XMLHttpRequest();
	        } else {
	            // code for IE6, IE5
	            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	        }
	        xmlhttp.onreadystatechange = function() {
	            if (this.readyState == 4 && this.status == 200) {
	                document.getElementById("CF-ajax-content").innerHTML = this.responseText;
	            }
	        };
	        xmlhttp.open("GET","products-reload.php",true);
	        xmlhttp.send();
	    }
	showContent();
	setInterval(showContent, 5000);
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