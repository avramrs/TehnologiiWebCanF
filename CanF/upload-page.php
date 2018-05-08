<!DOCTYPE html>
<html>
<head>
	<title>CanF</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body id="CF-can-upload" class="CF-no-margin CF-lightblue-background-color">
	
	<div id="CF-logo-section" >
		<div class="CF-template-container">
			<a href="Products.html">
				<img src="img/LogoTW2.png" alt="Logo">
			</a>
		</div>
	</div>

	<div id="CF-content-section" class="CF-template-container">
		<div id="CF-upload-text">
			<h1>Upload your<br>csv/xml file here:</h1>	
		</div>
		<form id="CF-upload-button" 
		action="php/upload.php"
		method="post"
		enctype="multipart/form-data">
			<label for="CF-file-browse">
				Choose File
			</label>
			<label for="CF-file-upload">
    			Upload
			</label>
			<input id="CF-file-browse" type="file" name="uploadFile">
			<input id="CF-file-upload" type="submit" name="submit"/>
		</form>
	</div>

</body>
</html>