<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password</title>

</head>
<body>
	<div class="header">
		<h2>Reset Password</h2>
	</div>

	<form method="post" action="register.php">

		<?php include('errors.php'); ?>

<!-- 		<div class="input-group">
			<label>Restaraunt Name</label>
			<input type="text" name="username" value="<?php echo $username; ?>">
		</div> -->
		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email" value="<?php echo $email; ?>">
		</div>
			<button type="submit" class="btn" name="forgot_password">Reset</button>

			Changed your mind? <a href="login.php">Sign in</a>
		</p>

	</form>
</body>
</html>
