<?php

	$canID = $_GET['id'];

	$mysql = new mysqli ('localhost', 'root',	'',	'TWProject');
	if (mysqli_connect_errno()) {
		die ('Conexiunea a esuat...');
	}

	if ($mysql->query ('delete from products where product_id=' . $canID . '') === TRUE) {
	    echo "Record deleted successfully";
	} else {
	    echo "Error deleting record: " . $mysql->error;
	}

	$mysql->close();
	header('Location: products.php');
?>