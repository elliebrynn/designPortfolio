<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Reset PasswordL</title>
	
</head>
<body>
	<div class="header">
		<h2>Reset Password</h2>
	</div>
	
	<form method="post" action="register.php">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>Restaraunt Name</label>
			<input type="text" name="username" value="<?php echo $username; ?>">
		</div>
		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email" value="<?php echo $email; ?>">
		</div>
		<div class="input-group">
			<label>New Password</label>
			<input type="password" name="password_1">
		</div>
		<div class="input-group">
			<label>Confirm New password</label>
			<input type="password" name="password_2">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="reset_password">Register</button>
		</div>
		<p>
			Already a member? <a href="login.php">Sign in</a>
		</p>
	</form>
</body>
</html>