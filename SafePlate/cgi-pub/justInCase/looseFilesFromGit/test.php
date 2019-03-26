

<!DOCTYPE html>
<html>
<head>
	<title>test</title>
</head>
<body>
	<?php 
	
function passFunc($len,$set=''){
	$gen ='';

	for($i=0;$i<$len;$i++){
		$set = str_shuffle($set);
		$gen .=$set[0];
	}
	return $gen;

}
	$passcode=passFunc(8,'abdefghijklmnopqrstuvwxyuvwxyz123456789')
	
	?>
<p>your code is <?php echo $passcode; ?> .</p>

</body>
</html>