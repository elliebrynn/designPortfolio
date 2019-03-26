<!DOCTYPE html>
<html>

<head>
	<title>Admin Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css?family=Concert+One" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

        <meta http-equiv="x-ua-compatible" content="ie=edge">


        <!-- Stylesheets -->
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all">
        <link href="css/hover-min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/normalize.css">

        <!-- script -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        

        <!--[if lt IE 9]>
            <script src="components/html5shiv/html5shiv.min.js"></script>
        <![endif]-->
</head>


<body>
 <div class="adminheader">
        <h1>SafePlate</h1>
</div>

 <ul id="nav-ul">
                <li id="nav-li">
                    <a  id="nav-a">admin</a>
                    <ul id="nav-ul" class="dropdown">
                        <li id="nav-li"><a  id="nav-a" href="http://cgi.soic.indiana.edu/~team01/adminInterface/login.php">Log out</a></li>
                    </ul>
                </li>
            </ul>

<a href="dashboard.php" class="backbtn">Go Back to Dashboard</a>

<?php
//Grabbing from ? in url
session_start();
$rest_id2=$_GET['id'];
$rest_id=(int)$rest_id2;
// var_dump($rest_id);
// $_SESSION['rest_id']=$rest_id;

//connection
$con=mysqli_connect("db.soic.indiana.edu","i494f17_team01","my+sql=i494f17_team01", "i494f17_team01");

//echoing restaurant name
$sql2="SELECT restaurant_name from restaurant WHERE restaurant_id='".$rest_id."'";
$result8=mysqli_query($con,$sql2);
$rows8=mysqli_fetch_assoc($result8);

echo "<h1>Menu for". " " .$rows8['restaurant_name']."</h1><br>";
//returning menu and allergens for restaurant
$sql="SELECT * from menu_item as m, allergen as a WHERE a.restaurant_id=m.restaurant_id  AND m.menu_item_id=a.menu_item_id AND m.restaurant_id='".$rest_id."'";
$result=mysqli_query($con,$sql);

//grabbing and converting user id to int
$sql9="SELECT user_id from restaurant where restaurant_id='".$rest_id."'";
$result2=mysqli_query($con,$sql9);
$user_id2=mysqli_fetch_assoc($result2);
$user_id=(int)$user_id2["user_id"];
// var_dump($user_id);
// echo($user_id);

//grabbing email based of user_id to send for comments
$sql10="SELECT email from users where user_id='".$user_id."'";
$result3=mysqli_query($con,$sql10);
$rows4=mysqli_fetch_assoc($result3);
$email=$rows4["email"];
echo $email;



//This is to limit how many times we show category
// $sql10="SELECT ema
// $rows=mysqli_fetch_assoc($result);
// var_dump($rows);
// $priorCategory = [];
// while($rows=mysqli_fetch_assoc($result)) {
// 	if (!in_array($rows['category'],$priorCategory)) {
// 		echo "<strong>". $rows['category']. "</strong><br>";
// 		$priorCategory[]=$rows['category'];
// 	}
// 	echo $rows['menu_item'], '<br>';
// }
// var_dump($priorCategory);
//  	
// $mysqli->close();

//THIS IS WHERE EVERYTHING WORKED
if (mysqli_num_rows($result)==0){
	echo "<h3>Restaurant has not submitted any menu information</h3>";
}
else{

echo "<table id='tableItems' border='1' cellpadding='10'><tr><th>Category</th><th>Menu Item</th><th>Allergen</th></tr>";
while($rows=mysqli_fetch_assoc($result)) {
		echo "<tr><td><strong>". $rows['category']. "</td></strong>";
		echo "<td>". $rows['menu_item']. "</td>";
    echo "<td>". $rows['allergen']. "</td></tr>";
}
}
echo "</table>";

?>
<form method ="post" >
<br>
<input type ='textarea' maxlength="500" name='comments' placeholder='Comments'><br><br>
<button type='submit' class='btn' name='approve'>Approve</button>
<button type='submit' class='btn' name='deny'>Deny</button>
</form>
<?php

//Commenting

//Deny
if(isset($_POST['deny'])){
	$comments = mysqli_real_escape_string($con,$_POST['comments']);
	// $query = "INSERT INTO restaurant (comment) values ('$comments')";
// 	mysqli_query($con,$query);
	$message2="You have denied ". $rows8['restaurant_name']. "'s menu";  
	$message ="Your menu has been denied by SafePlate's Admin Team. They made the following comments:'".$comments."'";
	echo ($message2);
	mail($email,"An Important message from the SafePlate Admin Team: ", $message,"From:safeplate01@gmail.com");
}

//Approve
if (isset($_POST['approve'])){
	//update database
	$updatequery= "UPDATE restaurant set approved='Y' where restaurant_id= '".$rest_id."'";
	mysqli_query($con,$updatequery);

	// //send email to restaurant that they have been approved
	$message = "Congrats, you approved a restaurant!";
	$message2 = "Congrats, your restaurant menu has been approved! You restaurant information and menu information can now be found on our website: https://cgi.soic.indiana.edu/~team01/userInterfaces/filter.php";
	// mail($email,"Message from SafePlate","Message from SafePlate"An Important Message From the SafePlate Admin Team: ",$message,"from:safeplate01@gmail.com");
 	echo($message);
 	mail($email,"An Important message from the SafePlate Admin Team", $message2,"From:safeplate01@gmail.com");
 	
	}
?>


</body>
</html>

