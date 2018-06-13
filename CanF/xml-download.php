<?php
	$canID = $_GET['id'];

	$mysql = new mysqli ('localhost', 'root',	'',	'TWProject');
	if (mysqli_connect_errno()) {
		die ('Conexiunea a esuat...');
	}

	if (!($rez = $mysql->query ('select * from products where product_id=' . $canID . ''))) {
		die ('A survenit o eroare la interogare');
	}

	$str ="<?xml version='1.0' encoding='UTF-8'?>\n<product>";

	while ($inreg = $rez->fetch_assoc()) {
	  	$str .= "\n\t<product_id>$inreg[product_id]</product_id>";
	  	$str .= "\n\t<user_id>$inreg[user_id]</user_id>";
	  	$str .= "\n\t<upload_date>$inreg[upload_date]</upload_date>";
		$str .= "\n\t<cans_number>$inreg[cans_number]</cans_number>";
		$str .= "\n\t<url_image>$inreg[url_image]</url_image>";
		$str .= "\n\t<name>$inreg[name]</name>";
		$str .= "\n\t<ingredients>$inreg[ingredients]</ingredients>";
		$str .= "\n\t<packaging>$inreg[packaging]</packaging>";
		$str .= "\n\t<quantity>$inreg[quantity]</quantity>";
		$str .= "\n\t<serving>$inreg[serving]</serving>";
		$str .= "\n\t<brand>$inreg[brand]</brand>";
		$str .= "\n\t<shop>$inreg[shop]</shop>";
		$str .= "\n\t<country>$inreg[country]</country>";
		$str .= "\n\t<made_in>$inreg[made_in]</made_in>";
	}

	$str.= "\n</product>";

	$file_name="product.xml"; // file name
	$fp = fopen ($file_name, "w");
	fwrite ($fp,$str);
	fclose ($fp);
	chmod($file_name,0777); 

	header('Content-type: text/xml');
	header('Content-Disposition: attachment; filename="product.xml"');

	echo $str;
?>