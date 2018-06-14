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

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){

		    var auto= $('#CF-ajax-can-content'), refreshed_content;	
				refreshed_content = setInterval(function(){
				auto.load('can-template-reload.php?id=<?php echo $canID; ?>');},
				1000);
				console.log(refreshed_content);										 
				return false; 
		});
	</script>
</head>
<body id="CF-can-template" class="CF-no-margin CF-lightblue-background-color">

	<div id="CF-logo-section" >
		<div class="CF-template-container">
			<a href="products.php">
				<img src="img/LogoTW2.png" alt="Logo">
			</a>
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
				</a>';

				if ((strcmp($_SESSION['user_data']['username'], 'admin') === 0) || ($_SESSION['user_data']['id'] == $userID)) {
					echo
					'<a href="update-form.php">
		  				Update
					</a>
					<a href="delete.php?id=' . $canID . '">
		  				Delete
					</a>';
				}
				
			echo '</div>';
		?>
	</div>

</body>
</html>