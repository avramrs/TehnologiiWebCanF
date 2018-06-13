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
				<?php

					$mysql = new mysqli ('localhost', 'root',	'',	'TWProject');
					if (mysqli_connect_errno()) {
						die ('Conexiunea a esuat...');
					}

					if (!($rez = $mysql->query ('select product_id, name, url_image from products'))) {
						die ('A survenit o eroare la interogare');
					}

					while ($inreg = $rez->fetch_assoc()) {
						echo
						   	'<a href="can-template.php?id=' . $inreg['product_id'] . '">
								<figure class="thumbnail">
										<img src="' . $inreg['url_image'] . '">
										<figcaption>' . $inreg['name'] . '</figcaption>
								</figure>
							</a>';
					}

					$mysql->close();	
				?>
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
