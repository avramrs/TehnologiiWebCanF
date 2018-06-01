<?php
session_start();
$user = null;
if(isset($_SESSION['user_data']))
{
	$user = $_SESSION['user_data'];

}
if(!$user)
{
	header('Location: Login.php');
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>CanF</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body class="CF-no-margin">
	<div id="CF-page">
		<div id="CF-products">
			<a id="CF-Logout" href="Logout.php">Logout</a>
		<div id=CF-search-results-text>

			<a id="CF-PDF" href="stocks.pdf" download target="_blank">
				STOCK
			</a><br />
			<input type="text" placeholder="Search..."><br />
			<span id="results">Results:</span>
		</div>
		<div id="CF-search-results">
			<a href="can-template.html">
				<figure class="thumbnail">
						<img src="img/conserva.jpg">
						<figcaption>Conserva</figcaption>
				</figure>
			</a>
			<a href="can-template.html">
				<figure class="thumbnail">
						<img src="img/conserva2.jpg">
						<figcaption>Conserva</figcaption>
				</figure>
			</a>
			<a href="can-template.html">
				<figure class="thumbnail">
						<img src="img/conserva3.jpg">
						<figcaption>Conserva</figcaption>
				</figure>
			</a>
			<a href="can-template.html">
				<figure class="thumbnail">
						<img src="img/conserva.jpg">
						<figcaption>Conserva</figcaption>
				</figure>
			</a>
			<a href="can-template.html">
				<figure class="thumbnail">
						<img src="img/conserva2.jpg">
						<figcaption>Conserva</figcaption>
				</figure>
			</a>
			<a href="can-template.html">
				<figure class="thumbnail">
						<img src="img/conserva3.jpg">
						<figcaption>Conserva</figcaption>
				</figure>
			</a>
			<a href="can-template.html">
				<figure class="thumbnail">
						<img src="img/conserva.jpg">
						<figcaption>Conserva</figcaption>
				</figure>
			</a>
			<a href="can-template.html">
				<figure class="thumbnail">
						<img src="img/conserva.jpg">
						<figcaption>Conserva</figcaption>
				</figure>
			</a>
			<a href="can-template.html">
				<figure class="thumbnail">
						<img src="img/conserva.jpg">
						<figcaption>Conserva</figcaption>
				</figure>
			</a>
			<a href="can-template.html" >
				<figure class="thumbnail">
					<img src="img/conserva2.jpg">
					<figcaption>Conserva cu cel mai lung nume din existenta conservelor, first of her name, the Unburnt, Queen of the Andals and the First Men, Khaleesi of the Great Grass Sea, Breaker of Chains, and Mother of Dragons</figcaption>
				</figure>
			</a>
			<a href="can-template.html">
				<figure class="thumbnail">
						<img src="img/conserva2.jpg">
						<figcaption>Conserva</figcaption>
				</figure>
			</a>
		</div>
	</div>
	</div>
	<div id="CF-title-section" >
		<div class="CF-container">
		<a href="Products.html">
			<img src="img/LogoTW2.png" alt="Logo">
		</a>
		<a href="upload-page.html">
			<img id=CF-import-button src="img/Import.png" alt="Logo">
		</a>
		</div>
	</div>
</body>
</html>
