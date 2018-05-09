<!DOCTYPE html>
<html>
<head>
	<title>CanF</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body class="CF-no-margin">
	<div id="CF-page">
		<div id="CF-products">
			<div id=CF-search-results-text>
				<a id="CF-PDF" href="stocks.pdf" download target="_blank">
					STOCK
				</a><br />
				<input type="text" placeholder="Search..."><br />
				<span id="results">Results:</span>
			</div>

			<!-- PHP -->
			<div id="CF-search-results">
				<?php

					$mysql = new mysqli ('localhost', 'root',	'',	'Cans');
					if (mysqli_connect_errno()) {
						die ('Conexiunea a esuat...');
					}

					if (!($rez = $mysql->query ('select Product_ID, Name, Image_URL from products'))) {
						die ('A survenit o eroare la interogare');
					}

					while ($inreg = $rez->fetch_assoc()) {
						echo
						   	'<a href="can-template.php?id=' . $inreg['Product_ID'] . '">
								<figure class="thumbnail">
										<img src="' . $inreg['Image_URL'] . '">
										<figcaption>' . $inreg['Name'] . '</figcaption>
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
			<a href="upload-page.html">
				<img id=CF-import-button src="img/Import.png" alt="Logo">
			</a>
		</div>
	</div>
</body>
</html>
