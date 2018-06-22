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
</head>
<body class="CF-no-margin">

		<div id="CF-page">
		    <div id="CF-Contact">  
            <h1>Contact</h1>
            <h3>If you have any complaints please send us an email.</h1>
            <a href="mailto:cannedfoodmanager@gmail.com">cannedfoodmanager@gmail.com</a>
            </div>  
        </div>

	<div id="CF-title-section" >
		<div class="CF-container">
		<a href="Products.php">
			<img src="img/LogoTW2.png" alt="Logo">
        </a>
        <a id="CF-import-button" href="Logout.php">Logout</a>
		</div>
	</div>

</body>
</html>
