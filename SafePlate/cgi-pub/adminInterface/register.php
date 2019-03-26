<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Registration</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link href="css/hover-min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Concert+One|Open+Sans" rel="stylesheet">
</head>
<body>
	<div class="header">
		<h1>safeplate</h1>
		<h2>create a new account</h2>
	</div>

	<form method="post" action="register.php">

		<?php include('errors.php'); ?>

	<!-- 	<div class="input-group">
			<input type="text" name="username" value="<?php echo $username; ?>" placeholder="Restaurant Name">
		</div> -->
		<div class="input-group">
			<input type="email" name="email" value="<?php echo $email; ?>" placeholder="Email">
		</div>
		<div class="input-group">
			<input type="password" name="password_1" placeholder="Password">
		</div>
		<div class="input-group">
			<input type="password" name="password_2" placeholder="Confirm Password">
		</div>
		<div class="input-group">
			<button type="submit" class="btn hvr-grow" name="reg_user">Let's Go!</button>
		</div>
	</form>

	<div class="registration sign-in">
		<p>Already a member?</p>
		<a href="login.php">Sign in</a>
	</div>
	<div class="element"></div> <!-- blue background shape -->
</body>
</html>
