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

	$canID = $_GET['id'];
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
	                document.getElementById("CF-ajax-can-content").innerHTML = this.responseText;
	            }
	        };
	        xmlhttp.open("GET","can-template-reload.php?id=<?php echo $canID; ?>",true);
	        xmlhttp.send();
	    }
	showContent();
	setInterval(showContent, 5000);
	</script>
</head>
<body id="CF-can-template" class="CF-no-margin CF-lightblue-background-color">

	<div id="CF-logo-section" >
		<div class="CF-template-container">
			<a href="products.php">
				<img src="img/LogoTW2.png" alt="Logo">
			</a>
			<a id="CF-import-button" href="Logout.php">Logout</a>
		</div>
	</div>

	<div id="CF-content-section" class="CF-template-container">
		<div id="CF-ajax-can-content"> </div>
		<?php
			echo
			'<div id="CF-download-buttons" class="CF-center-aligned-text">
				<a href="csv-download.php?id=' . $canID . '">
	  				Download .csv
				</a>
				<a href="xml-download.php?id=' . $canID . '">
	  				Download .xml
				</a>
			</div>';
		?>
	</div>

</body>
</html>