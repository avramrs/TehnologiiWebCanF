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

	// $result = $mysql->query("SELECT * FROM products WHERE product_id=" . $canID);
	// $productInfo = $result->fetch_row();
	// if (!((strcmp($_SESSION['user_data']['username'], 'admin') === 0) || ($_SESSION['user_data']['id'] == $productInfo[1]))) {
	//     header('Location: index.php');
	// }

	if ($mysql->query ('delete from products where product_id=' . $canID . '') === TRUE) {
	    echo "Record deleted successfully";
	} else {
	    echo "Error deleting record: " . $mysql->error;
	}

	$mysql->close();
	header('Location: products.php');
?>