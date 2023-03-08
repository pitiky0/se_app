<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<h1>Login</h1>
	<?php
	session_start();
	require_once 'db_connection.php';
	require_once 'controllers/ProfesseurController.php';

	// check if user is already logged in
	if (isset($_SESSION['user'])) {
		header("Location: index.php");
		exit;
	}

	// define variables and set to empty values
	$email = $password = "";
	$email_err = $password_err = "";

	// process form data when submitted
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		// check if email is empty
		if (empty(trim($_POST["email"]))) {
			$email_err = "Please enter your email.";
		} else {
			$email = trim($_POST["email"]);
		}

		// check if password is empty
		if (empty(trim($_POST["password"]))) {
			$password_err = "Please enter your password.";
		} else {
			$password = trim($_POST["password"]);
		}

		// validate credentials
		if (empty($email_err) && empty($password_err)) {
			$controller = new ProfesseurController($db);
			if ($controller->loginProfesseur($email, $password)) {
				// store user information in session
				$user = $controller->getProfesseurByEmail($email);
				$_SESSION['user'] = $user;
				header("Location: index.php");
				exit;
			} else {
				$password_err = "Invalid email or password.";
			}
		}
	}
	?>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<label for="email">Email:</label>
		<input type="text" id="email" name="email" value="<?php echo $email; ?>">
		<span style="color: red;"><?php echo $email_err; ?></span>
		<br>
		<label for="password">Password:</label>
		<input type="password" id="password" name="password">
		<span style="color: red;"><?php echo $password_err; ?></span>
		<br>
		<input type="submit" value="Login">
	</form>
</body>
</html>
