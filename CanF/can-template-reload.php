
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
							<th>Quantity:</th>
							<th>' . $inreg['quantity'] . '</th>
						</tr>
						<tr>
							<th>Serving:</th>
							<th>' . $inreg['serving'] . '</th>
						</tr>
						<tr>
							<th>Brands:</th>
							<th>' . $inreg['brand'] . '</th>
						</tr>
						<tr>
							<th>Shops where sold:</th>
							<th>' . $inreg['shop'] . '</th>
						</tr>
						<tr>
							<th>Countries where sold:</th>
							<th>' . $inreg['country'] . '</th>
						</tr>
						<tr>
							<th>Made in:</th>
							<th>' . $inreg['made_in'] . '</th>
						</tr>
						<tr>
							<th>In stock:</th>
							<th>' . $inreg['cans_number'] . '</th>
						</tr>
					</table>
				</div>
			</div>';

		if ((strcmp($_SESSION['user_data']['username'], 'admin') === 0) || ($_SESSION['user_data']['id'] == $userID)) {
					echo
					'<div id="CF-download-buttons" class="CF-center-aligned-text">
					<a href="update-form.php?id=' . $canID . '">
		  				Update
					</a>
					<a href="delete.php?id=' . $canID . '">
		  				Delete
					</a>
					</div>';
				}
				else { echo '</div>';}
	}

	$mysql->close();
?>