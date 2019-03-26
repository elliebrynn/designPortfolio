<?php
$con=mysqli_connect("db.soic.indiana.edu","i494f17_team01","my+sql=i494f17_team01", "i494f17_team01");
// Check connection
if (mysqli_connect_errno())
{echo nl2br("Failed to connect to MySQL: " . mysqli_connect_error() . "\n "); }
else 
{ echo nl2br("Established Database Connection \n");}

//escape variables for form input values (text)
$sanrestname = mysqli_real_escape_string($con, $_POST['restaurantname']);
$sanphonenumber = mysqli_real_escape_string($con, $_POST['phonenumber']);
$sanaddresslineone = mysqli_real_escape_string($con, $_POST['addresslineone']);
$sanaddresslinetwo = mysqli_real_escape_string($con, $_POST['addresslinetwo']);
$sancity = mysqli_real_escape_string($con, $_POST['city']);
$sanstate = mysqli_real_escape_string($con, $_POST['state']);
$sanzip = mysqli_real_escape_string($con, $_POST['zip']);

//escape variables for hours - day 1
$sandays1 = mysqli_real_escape_string($con, $_POST['days1']);
$sanoc1 = mysqli_real_escape_string($con, $_POST['OC1']);
$santimeopenm = mysqli_real_escape_string($con, $_POST['timeopenM']);
$santimeclosem = mysqli_real_escape_string($con, $_POST['timecloseM']);
//escape variables for hours - day 2
$sandays2 = mysqli_real_escape_string($con, $_POST['days2']);
$sanoc2 = mysqli_real_escape_string($con, $_POST['OC2']);
$santimeopent = mysqli_real_escape_string($con, $_POST['timeopenT']);
$santimecloset = mysqli_real_escape_string($con, $_POST['timecloseT']);
//escape variables for hours - day 3
$sandays3 = mysqli_real_escape_string($con, $_POST['days3']);
$sanoc3 = mysqli_real_escape_string($con, $_POST['OC3']);
$santimeopenw = mysqli_real_escape_string($con, $_POST['timeopenW']);
$santimeclosew = mysqli_real_escape_string($con, $_POST['timecloseW']);
//escape variables for hours - day 4
$sandays4 = mysqli_real_escape_string($con, $_POST['days4']);
$sanoc4 = mysqli_real_escape_string($con, $_POST['OC4']);
$santimeopenr = mysqli_real_escape_string($con, $_POST['timeopenR']);
$santimecloser = mysqli_real_escape_string($con, $_POST['timecloseR']);
//escape variables for hours - day 5
$sandays5 = mysqli_real_escape_string($con, $_POST['days5']);
$sanoc5 = mysqli_real_escape_string($con, $_POST['OC5']);
$santimeopenf = mysqli_real_escape_string($con, $_POST['timeopenF']);
$santimeclosef = mysqli_real_escape_string($con, $_POST['timecloseF']);
//escape variables for hours - day 6
$sandays6 = mysqli_real_escape_string($con, $_POST['days6']);
$sanoc6 = mysqli_real_escape_string($con, $_POST['OC6']);
$santimeopens = mysqli_real_escape_string($con, $_POST['timeopenS']);
$santimecloses = mysqli_real_escape_string($con, $_POST['timecloseS']);
//escape variables for hours - day 7
$sandays7 = mysqli_real_escape_string($con, $_POST['days7']);
$sanoc7 = mysqli_real_escape_string($con, $_POST['OC7']);
$santimeopenu = mysqli_real_escape_string($con, $_POST['timeopenU']);
$santimecloseu = mysqli_real_escape_string($con, $_POST['timecloseU']);
//escape variable for ethnicity checkboxes
$sanentry=implode(',',$_REQUEST["boxsize"]);
$sanethnicity=mysqli_real_escape_string($con, $sanentry);

// $sanethnicity = mysqli_real_escape_string($con, $_POST['boxsize[]']);
//Insert query to insert form data into the restaurant table
$sql="INSERT INTO restaurant(restaurant_name,phone_number,address_1,address_2,city,state,zip) VALUES ('$sanrestname','$sanphonenumber','$sanaddresslineone','$sanaddresslinetwo','$sancity', '$sanstate', '$sanzip')";

//escape variable used to grab restaurant id for foreign key insertion (hours table)
if ($con->query($sql) === TRUE) {
echo "New record created successfully\n";
echo "New record has id: " . mysqli_insert_id($con);
} else {
die("Error: " . $sql . "<br>" . $con->error);
}

//escape variable used to grab restaurant id for foreign key insertion (hours table)
$sanrestid=mysqli_insert_id($con);
//Insert query to form data into the hours table
$sql2="INSERT INTO hours(restaurant_id,day,open_closed,start_time,end_time)VALUES('$sanrestid','$sanoc1','$sandays1', '$santimeopenm', '$santimeclosem'), ('$sanrestid','$sanoc2','$sandays2', '$santimeopent', '$santimecloset'), ('$sanrestid','$sanoc3','$sandays3', '$santimeopenw', '$santimeclosew'), ('$sanrestid','$sanoc4','$sandays4', '$santimeopenr', '$santimecloser'), ('$sanrestid','$sanoc5','$sandays5', '$santimeopenf', '$santimeclosef'), ('$sanrestid','$sanoc6','$sandays6', '$santimeopens', '$santimecloses'), ('$sanrestid','$sanoc7','$sandays7', '$santimeopenu', '$santimecloseu')";
//check for error on insert
// if (!mysqli_query($con,$sql))
// { die('Error: ' . mysqli_error($con)); }
if ($con->query($sql2) === TRUE) {
echo "New record in hours table created \n";
} else {
die("Error: " . $sql2 . "<br>" . $con->error);
}
$sql3="INSERT INTO ethnicity(restaurant_id,ethnicity)VALUES('$sanrestid','$sanethnicity')";
if ($con->query($sql3) === TRUE) {
header('location: http://cgi.soic.indiana.edu/~team01/BO_interfaces/menu_form.html');

echo "New record in ethnicity table created \n";
} else {
die("Error: " . $sql3 . "<br>" . $con->error);
}
mysqli_close($con);
?>
