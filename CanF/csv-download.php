<?php
	$canID = $_GET['id'];

	$mysql = new mysqli ('localhost', 'root',	'',	'TWProject');
	if (mysqli_connect_errno()) {
		die ('Conexiunea a esuat...');
	}

	if (!($rez = $mysql->query ('select * from products where product_id=' . $canID . ''))) {
		die ('A survenit o eroare la interogare');
	}

	$delimiter = ",";
	$file_name="product.csv";
	$fp = fopen ('php://memory', "w");
	
	$fields = array('cans_number', 'url_image', 'name', 'ingredients', 'packaging', 'quantity', 'serving', 'brand', 'shop', 'country', 'made_in');

	fputcsv($fp, $fields, $delimiter);
 
 	while($inreg = $rez->fetch_assoc()){
        $lineData = array($inreg['cans_number'], $inreg['url_image'], $inreg['name'], $inreg['ingredients'], $inreg['packaging'], $inreg['quantity'], $inreg['serving'], $inreg['brand'], $inreg['shop'], $inreg['country'], $inreg['made_in']);
        fputcsv($fp, $lineData, $delimiter);
    }

    fseek($fp, 0);

	header('Content-type: text/csv');
	header('Content-Disposition: attachment; filename="product.csv"');

	fpassthru($fp);
?>