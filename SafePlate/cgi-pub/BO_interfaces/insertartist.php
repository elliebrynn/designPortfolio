<?php
$con=mysqli_connect("db.soic.indiana.edu","i494f17_team01","my+sql=i494f17_team01", "i494f17_team01");
// Check connection
// if (mysqli_connect_errno())
// {echo nl2br("Failed to connect to MySQL: " . mysqli_connect_error() . "\n "); }
// else 
// { echo nl2br("Established Database Connection \n");}

//escape variables for form input values (text)
$sanemail=mysqli_real_escape_string($con, $_POST['email']);
$sanrestname = mysqli_real_escape_string($con, $_POST['restaurantname']);
$sanphonenumber = mysqli_real_escape_string($con, $_POST['phonenumber']);
$sanaddresslineone = mysqli_real_escape_string($con, $_POST['addresslineone']);
$sanaddresslinetwo = mysqli_real_escape_string($con, $_POST['addresslinetwo']);
$sancity = mysqli_real_escape_string($con, $_POST['city']);
$sanstate = mysqli_real_escape_string($con, $_POST['state']);
$sanzip = mysqli_real_escape_string($con, $_POST['zip']);

//grabbing user_id
$sql8="SELECT user_id FROM users WHERE email='".$sanemail."'";
$result=mysqli_query($con,$sql8);
$rows=mysqli_fetch_assoc($result);
$user_id=(int)$rows['user_id'];
// var_dump($user_id);
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
//escape variables for file upload(photos)
$imagetmp=$_FILES["image"]['tmp_name'];
// $image=($_FILES["image"]['tmp_name']);
// $image=file_get_contents($image);
$image_name = ($_FILES['image']['name']);
$filepath="photo/".$image_name;
move_uploaded_file($imagetmp,$filepath);

// $image=base64_encode($image);
// $image_name = ($_FILES['image']['name']);
// $image_size=getimagesize($_FILES['image']['tmp_name']);
// if ($image_size==FALSE){
// 	echo "that's not an image";
// }
// else{
// $sanethnicity = mysqli_real_escape_string($con, $_POST['boxsize[]']);
//Insert query to insert form data into the restaurant table
$sql="INSERT INTO restaurant(restaurant_name,phone_number,address_1,address_2,city,state,zip,filename,image,user_id) VALUES ('$sanrestname','$sanphonenumber','$sanaddresslineone','$sanaddresslinetwo','$sancity', '$sanstate', '$sanzip','$image_name','$filepath',$user_id)";

//escape variable used to grab restaurant id for foreign key insertion (hours table)
$con->query($sql);
// echo "New record created successfully\n";
// echo "New record has id: " . mysqli_insert_id($con);
// } else {
// die("Error: " . $sql . "<br>" . $con->error);
// }

//escape variable used to grab restaurant id for foreign key insertion (hours table)
$sanrestid=mysqli_insert_id($con);
//Insert query to form data into the hours table
$sql2="INSERT INTO hours(restaurant_id,day,open_closed,start_time,end_time)VALUES('$sanrestid','$sanoc1','$sandays1', '$santimeopenm', '$santimeclosem'), ('$sanrestid','$sanoc2','$sandays2', '$santimeopent', '$santimecloset'), ('$sanrestid','$sanoc3','$sandays3', '$santimeopenw', '$santimeclosew'), ('$sanrestid','$sanoc4','$sandays4', '$santimeopenr', '$santimecloser'), ('$sanrestid','$sanoc5','$sandays5', '$santimeopenf', '$santimeclosef'), ('$sanrestid','$sanoc6','$sandays6', '$santimeopens', '$santimecloses'), ('$sanrestid','$sanoc7','$sandays7', '$santimeopenu', '$santimecloseu')";
//check for error on insert
// if (!mysqli_query($con,$sql))
// { die('Error: ' . mysqli_error($con)); }
$con->query($sql2);
// echo "New record in hours table created \n";
// } else {
// die("Error: " . $sql2 . "<br>" . $con->error);
// }
foreach($_REQUEST["boxsize"] as $k => $ethnicity) {
			$sanethnicity=mysqli_real_escape_string($con, $ethnicity);
			$sql3="INSERT INTO ethnicity(restaurant_id,ethnicity)VALUES('$sanrestid','$sanethnicity')";			
			$con->query($sql3); 
			// 	echo "New record in ethnicity table created \n";
// 			} else {
// 				die("Error: " . $sql3 . "<br>" . $con->error);
// 			}
		}
//display images
// $sql4="SELECT filename,image FROM restaurant"; 
// $result=mysqli_query($con,$sql4);
// while($row=mysqli_fetch_array($result))
// {
// 	echo '<img src=photo/lebron.jpg height="100" width="100">';
// 	// echo '<img height="300" width="300" src="data:image;base64,'.$row[2].' "> ';
// // 	echo '<img src='.$row["image"].'height="100" width="100">';
// }
mysqli_close($con);

?>

<html>
<head>
	<title>Profile Creation</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css?family=Concert+One" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <link rel="stylesheet" type="text/css" href="css/normalize.css">

        <!-- Stylesheets -->
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all">
        <link href="css/hover-min.css" rel="stylesheet">

        <!-- script -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<!-- Font Awesome - for icon usage -->
	<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
	<!--[if lt IE 9]>
            <script src="components/html5shiv/html5shiv.min.js"></script>
        <![endif]-->
</head>
	

<body>
	<div class="header">
		<div class="res-icon">
    	<img src="images/noun_186747_cc.svg">
    	<img src="images/noun_190343_cc.svg">
	</div>
    <h1 id="rescreen">Congrats!</h1>
    
	<h2 id="resphead">Your restaurant account has been created. Please continue to create your menu.</h2>

	<!-- response leads to menu form TEST THE MENU (make another response) home button that leads to their homepage,  -->
	<a href="http://cgi.soic.indiana.edu/~team01/BO_interfaces/menu_form.html" class="contbtn">Create Menu</a>
</div>














</body>
</html>