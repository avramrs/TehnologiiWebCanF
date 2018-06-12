<?php
$error = null;

if(isset($_POST['user'])&&isset($_POST['password']))
{
	$pass = $_POST['password'];
	$user = trim($_POST['user']);
	if(!preg_match('/[a-zA-Z0-9]+/',$user))
	{
		$error = 'Username must contain only letters and digits.';
	}
	if(!preg_match('/[a-zA-Z0-9]+/',$pass))
	{
		$error = 'Password must contain only letters and digits.';
	}
	if(!($error)&&(strlen($pass)<6))
	{
		$error = 'Password must be longer than 6 charaters!!';
	}
	if(!$error)
	{
		$mysql = new mysqli (
			'localhost', // locatia serverului (aici, masina locala)
			'root',       // numele de cont
			'',    // parola (atentie, in clar!)
			'TWProject'   // baza de date
		);
		if (mysqli_connect_errno()) {
			$error = 'Nu s-o conectat!!';
		}
		if($userquery = $mysql->query('SELECT `username` FROM `users` WHERE `username` LIKE "'.$user.'"'))
		{
			if($userquery->num_rows>0)
			{
				$error = 'Try different username.';
			}

		}
		// formulam o interogare si o executam
		if (!($error)&&!($rez = $mysql->query ('INSERT INTO `users` (`username`, `password`) VALUES ( "'.$user.'", "'.password_hash($pass,PASSWORD_DEFAULT).'")'))) {
			$error = 'User not created.';
		}

		if(!$error)
		{
			header('Location: Login.php');
		}
	}
}






?>
<!DOCTYPE html>
<html>
<head>
	<title>CanF</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body class="CF-no-margin">

		<div id="CF-LoginBox">
			<p id="CF-Text">Choose your account details!</p>
			<form action="Register.php" method="post">
				<?php if($error): ?>
					<div id="CF-Error">ERROR: <?php echo $error; ?> </div>
				<?php endif; ?>
				<p>
					<p id="CF-Text2">Username </p>
					<input type=text id="CF-TextField" name="user" />
				</p>
				<p>
					<p id="CF-Text2">Password </p>
					<input type=password id="CF-TextField" name="password" />

				</p>
				<p>
					<table id="CF-LoginBtn">
						<tr>
							<th id=CF-Text2>
								<input type=submit id="CF-Btn" value="Register" />
							</th>
							<th>

							</th>
							<th>



							</th>
						</tr>
					</table>

				</p>
			</form>
		</div>


	<div id="CF-title-section" >
		<div class="CF-container">

		<img src="img/LogoTW2.png" alt="Logo">

		</div>
	</div>

</body>
</html>
