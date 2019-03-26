<?php include('server.php') ?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Verification</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link href="css/hover-min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Concert+One|Open+Sans" rel="stylesheet">
</head>
<body>
	<div class="header">
		<h2>Verify</h2>
	</div>

	<form method="post" action="verify.php">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>Restaurant Name</label>
			<input type="text" name="username" value="<?php echo $username; ?>">
		</div>
		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email" value="<?php echo $email; ?>">
		</div>
		<div class="input-group">
			<label>Code</label>
			<input type="text" name="code" value="<?php echo $code; ?>">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="verify_user">Verify</button>
		</div>


</body>
</html>
