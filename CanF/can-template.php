<!DOCTYPE html>
<html>
<head>
	<title>CanF</title>
	<link rel="stylesheet" href="css/style.css">
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
		<?php

			$canID = $_GET['id'];

			$mysql = new mysqli ('localhost', 'root',	'',	'Cans');
					if (mysqli_connect_errno()) {
						die ('Conexiunea a esuat...');
					}

					if (!($rez = $mysql->query ('select * from products where Product_ID=' . $canID . ''))) {
						die ('A survenit o eroare la interogare');
					}

					while ($inreg = $rez->fetch_assoc()) {
						echo
					   	'<div id="CF-can-image">
							<img src="' . $inreg['Image_URL'] . '" alt="can image">
						</div>
						<div id="CF-can-details">
							<div class="CF-center-aligned-text CF-helvetica-font CF-darkblue-color">
								<h1>' . $inreg['Name'] . '</h1>
							</div>

							<div class="CF-can-details-table">
								<table>
									<tr>
										<th>Ingredients:</th>
										<th>' . $inreg['Ingredients'] . '</th>
									</tr>
									<tr>
										<th>Packaging:</th>
										<th>' . $inreg['Packaging'] . '</th>
									</tr>
								</table>
							</div>
						</div>';
					}

					$mysql->close();
		?>

		<div id="CF-download-buttons" class="CF-center-aligned-text">
			<a download href="can-template.html">
  				Download .csv
			</a>
			<a download href="cans.xml">
  				Download .xml
			</a>
		</div>
	</div>

</body>
</html>