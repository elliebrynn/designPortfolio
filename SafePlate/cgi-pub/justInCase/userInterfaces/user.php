<?php
$con=mysqli_connect("db.soic.indiana.edu","i494f17_team01","my+sql=i494f17_team01", "i494f17_team01");
// Check connection
if (mysqli_connect_errno())
{echo nl2br("Failed to connect to MySQL: " . mysqli_connect_error() . "\n "); }
else 
{ echo nl2br("Established Database Connection \n");}
//escape variables for allergen
$sanentry=implode(',',$_REQUEST["boxsize"]);
$allergen=mysqli_real_escape_string($con, $sanentry);
//escape variables for ethnicites
$category = mysqli_real_escape_string($con, $_POST['category']);



?>