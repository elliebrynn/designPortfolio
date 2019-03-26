<?php
//: these first few lines are to configure var_dump so that it shows deeper arrays (line 6 is a var_dump to show the array)
ini_set('xdebug.var_display_max_depth', 10);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);
// var_dump($_POST);
//$con=mysqli_connect("db.soic.indiana.edu","i494f17_team01","my+sql=i494f17_team01", "i494f17_team01");
$con=mysqli_connect("db.soic.indiana.edu","i494f17_team01","my+sql=i494f17_team01", "i494f17_team01");
// Check connection
// if (mysqli_connect_errno()){
// 	echo nl2br("Failed to connect to MySQL: " . mysqli_connect_error() . "\n "); 
// } else {
// 	echo nl2br("Established Database Connection \n");
// }
$restname = mysqli_escape_string($con,$_POST['restname']);
$sql="select restaurant_id from restaurant where restaurant_name = '$restname'";
$result = $con->query($sql);
	$restId=$result->fetch_assoc()['restaurant_id'];
// 	echo "Found restaurant id '$restId' of '$restname'";
// }
//escape text box values
foreach($_POST['menusection'] as $i => $section) {
	
	$category = mysqli_escape_string($con,$section['name']);
	
	foreach($section['menuitem'] as $j => $menuitem) {
		$menu_item = mysqli_escape_string($con,$menuitem['name']);
		
		$sql = "INSERT into menu_item (restaurant_id, menu_item, category) values ('$restId', '$menu_item' , '$category')";
		
		$con->query($sql);
		// 	echo "New record in menu_item table created \n";
// 		} else {
// 			die("Error: " . $sql . "<br>" . $con->error);
// 		}
		//get menu item id
		$menu_item_id=mysqli_insert_id($con);
		
		// LOOPING THROUGH EACH SET OF ALLERGENS ENTERED.
		if (isset($menuitem['checkbox'])) { 
		foreach($menuitem['checkbox'] as $k => $allergen) {
			$allergen=mysqli_real_escape_string($con, $allergen);
			$allergen=ucfirst($allergen);
			if ($allergen=="Soy"){
			$allergen="Soy2";
			}	
			$sql2="INSERT INTO allergen (restaurant_id,menu_item_id,allergen) VALUES( '$restId','$menu_item_id','$allergen')";
			$con->query($sql2);
// 				echo "New record in allergen table created \n";
// 			} else {
// 				die("Error: " . $sql2 . "<br>" . $con->error);
// 			}
		// }
		}
		} else {
			$sql="INSERT INTO allergen (restaurant_id,menu_item_id,allergen) VALUES( '$restId','$menu_item_id','None')";
			$con->query($sql);
			// 	echo "New record in allergen table created \n";
// 			} else {
// 				die("Error: " . $sql . "<br>" . $con->error);
 			}
		}
	}
mysqli_close($con);
//insert query
//TESTING.....
// $insert ="SELECT restaurant_id from restaurant where restaurant_name = '$restname' ";
// $insertquery = mysqli_query($insert);
// $rest_id = intval($insertquery);
// $sql = "INSERT INTO menu_item (restaurant_id , menu_item , category ) VALUES ( '$rest_id', '$menuitem' ,'$menu_section') ";
// 
// $query = "INSERT INTO menu_item (restaurant_id, menu_item, category) VALUES (?,?,?,?) ";
// $stmt = $con -> link -> prepare($query);
// $stmt -> bind_param('iiss', $category);
// $retrieve = "SELECT restaurant_id from restaurant where restaurant_name = '$restname' " ;
// $retrieveqry = mysqli_query($con , $retrieve);
// $restid = int($retrieveqry);
// $sql = "INSERT INTO menu_item (restaurant_id ) VALUES  ('$restid') ";
// $sql =  "INSERT INTO menu_item (restaurant_id)  select restaurant_id from restaurant where restaurant_name
//  = '$restname'  ";
//  $rest_id = mysqli_query($sql);
//  // $rest_id = mysqli_insert_id($con);
//  // $finalqry = "UPDATE menu_item set menu_item = '$menu_item', category = '$category' where restaurant_id = '$rest_id' ";
//ACTUALLY WORKS!!!
?>

<html>
<head>
	<title>Menu Creation</title>
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
    <h1 id="rescreen">Awesome!</h1>
    
	<h2 id="resphead">Your restaurant menu has been submitted for approval.</h2>

	<!-- response leads to menu form TEST THE MENU (make another response) home button that leads to their homepage,  -->
	<a href="http://cgi.soic.indiana.edu/~team01/loginRegister/login.php" class="contbtn">Go to Login</a>
</div>