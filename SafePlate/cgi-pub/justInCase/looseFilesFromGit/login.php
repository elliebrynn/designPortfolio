<?php include('server.php') ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Registration system PHP and MySQL</title>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
		<link href="css/hover-min.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Concert+One|Open+Sans" rel="stylesheet">
	</head>
	<body>
		<div class="main">
		<div class="header">
				<h1>safeplate</h1>
				<div class="subhead">
					<h2>A guide for somewhere safe to dine<br>&mdash; no fear of food allergens!</h2>
					<img src="images/noun_186747_cc.svg" alt="fork icon" class="fork">
					<img src="images/noun_190343_cc.svg" alt="spoon icon" class="spoon">
					<!-- “fork” and "spoon" icons by Anbileru Adaleru, from thenounproject.com. -->
				</div>
			</div>

			<form method="post" action="login.php">

				<?php include('errors.php'); ?>

				<div class="input-group">
					<input type="text" name="email" placeholder="Email">
				</div>
				<div class="input-group">
					<input type="password" name="password" placeholder="Password">
				</div>
				<div class="input-group">
					<button type="submit" class="btn hvr-grow" name="login_user">Login</button>
				</div>
			</form>

			<div class="registration">
				<p>I&rsquo;m new</p>
				<p>around here!</p>
				<a href="register.php">register</a>
			</div>
		</div><!--  main  -->
		<!-- <div class="element"></div> blue background shape --> 
	</body>
</html>
