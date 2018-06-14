<?php

	$canID = $_GET['id'];
	
	$mysql = new mysqli ('localhost', 'root',	'',	'TWProject');
	if (mysqli_connect_errno()) {
		die ('Conexiunea a esuat...');
	}

	if (!($rez = $mysql->query ('select * from products where product_id=' . $canID . ''))) {
		die ('A survenit o eroare la interogare');
	}

	while ($inreg = $rez->fetch_assoc()) {

		$userID = $inreg['user_id'];

		echo
		   	'<div id="CF-can-image">
				<img src="' . $inreg['url_image'] . '" alt="can image">
			</div>
			<div id="CF-can-details">
				<div class="CF-center-aligned-text CF-helvetica-font CF-darkblue-color">
					<h1>' . $inreg['name'] . '</h1>
				</div>

				<div class="CF-can-details-table">
					<table>
						<tr>
							<th>Ingredients:</th>
							<th>' . $inreg['ingredients'] . '</th>
						</tr>
						<tr>
							<th>Packaging:</th>
							<th>' . $inreg['packaging'] . '</th>
						</tr>
						<tr>
							<th>Serving:</th>
							<th>' . $inreg['serving'] . '</th>
						</tr>
					</table>
				</div>
			</div>';
	}

	$mysql->close();
?>