<?php
session_start();
$error = null;

if(isset($_POST['user'])&&isset($_POST['password']))
{
	$pass = $_POST['password'];
	$user = trim($_POST['user']);

	$mysql = new mysqli (
		'localhost', // locatia serverului (aici, masina locala)
		'root',       // numele de cont
		'',    // parola (atentie, in clar!)
		'TWProject'   // baza de date
	);

	$query = $mysql->prepare("SELECT username,password FROM users WHERE username LIKE ?");
	$query->bind_param("s",$user);
	$rez = $query->execute();
	$query->bind_result($username,$password);
	$query->fetch();


	if(!$username)
	{
		$error = 'Username not registered.';
	}
	if(!$error)
	{
		$passhash = password_hash($pass,PASSWORD_DEFAULT);

		if(!password_verify($pass,$password))
		{

			$error = 'Incorrect password.';
		}

		if(!$error)
		{
			session_start();
			$_SESSION['user_data'] = array(
					'username'=>$username

			);
			header('Location: products.php');
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
			<p id="CF-Text">Login with your acount!</p>
			<form action="Login.php" method="post">
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
							<th>
								<input type=submit id="CF-Btn" value="Login" />
							</th>
							<th>
								<p id="CF-Text2">Or</p>
							</th>
							<th>
								<a  href="Register.php">
									<p id="CF-Btn">Register </p>
								</a>


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
