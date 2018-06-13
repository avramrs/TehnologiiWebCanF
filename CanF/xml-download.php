<?php
	$canID = $_GET['id'];

	$mysql = new mysqli ('localhost', 'root',	'',	'TWProject');
	if (mysqli_connect_errno()) {
		die ('Conexiunea a esuat...');
	}

	if (!($rez = $mysql->query ('select * from products where product_id=' . $canID . ''))) {
		die ('A survenit o eroare la interogare');
	}

	$str = '<?xml version="1.0" encoding="utf-8"?>';
	$str .= "\n<products>\n\t<product>";

	while ($inreg = $rez->fetch_assoc()) {
		$str .= "\n\t\t<cans_number>$inreg[cans_number]</cans_number>";
		$str .= "\n\t\t<url_image>$inreg[url_image]</url_image>";
		$str .= "\n\t\t<name>$inreg[name]</name>";
		$str .= "\n\t\t<ingredients>$inreg[ingredients]</ingredients>";
		$str .= "\n\t\t<packaging>$inreg[packaging]</packaging>";
		$str .= "\n\t\t<quantity>$inreg[quantity]</quantity>";
		$str .= "\n\t\t<serving>$inreg[serving]</serving>";
		$str .= "\n\t\t<brand>$inreg[brand]</brand>";
		$str .= "\n\t\t<shop>$inreg[shop]</shop>";
		$str .= "\n\t\t<country>$inreg[country]</country>";
		$str .= "\n\t\t<made_in>$inreg[made_in]</made_in>";
	}

	$str.= "\n\t</product>\n</products>";

	$file_name="product.xml";
	$fp = fopen ($file_name, "w");
	fwrite ($fp,$str);
	fclose ($fp);
	chmod($file_name,0777); 

	header('Content-type: text/xml');
	header('Content-Disposition: attachment; filename="product.xml"');

	echo $str;
?>