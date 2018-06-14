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