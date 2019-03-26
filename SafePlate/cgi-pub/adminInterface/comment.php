<?php include('commenting.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title> testing</title>
</head>
<body>
<form method ="post" action='comment.php'>
	<?php include(testing.php);
	?>
<input type= 'textarea' name='restaurant' placeholder='restaurant name'>
<input type ='textarea' name='comments' placeholder='Comments'>
<button type='submit' name='approve'>Approve</button>
<button type='submit' name='deny'>Deny</button>
</form>
</body>
</html>