<?php
	session_start();
	$con=mysqli_connect("db.soic.indiana.edu","i494f17_team01","my+sql=i494f17_team01", "i494f17_team01");

// 	if (!isset($_SESSION['email'])) {
// 		$_SESSION['msg'] = "You must log in first";
// 		header('location: login.php');
// 	}
// 
// 	if (isset($_GET['logout'])) {
// 		session_destroy();
// 		unset($_SESSION['email']);
// 		header("location: login.php");
// 	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="css/hover-min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Concert+One|Open+Sans" rel="stylesheet">

</head>

 <div class="adminheader">
    <h1>SafePlate</h1>
</div>
<div class="header">
	<h2>Edit Profile</h2>
</div>

<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->

    <ul id="nav-ul">
			<li id="nav-li">
			    <a  id="nav-a"><?php echo $_SESSION['username']; ?></a>
			    <ul id="nav-ul" class="dropdown">
			        <li id="nav-li"><a  id="nav-a" href="print_profile.php?logout='1'">Log out</a></li>
			        <li id="nav-li"><a  id="nav-a" href="index.php">Edit info</a></li>
			    </ul>
			</li>
		</ul>

    <?php  if (isset($_SESSION['email'])) : ?>
    	<a href="print_profile.php" class="backbtn">Go Back to Profile</a>
    	<?php 
    	//pull General restaurant info
    	// var_dump($_POST);
    	$sql="SELECT * FROM restaurant WHERE user_id='".$_SESSION['user_id']."'";
	    $result=mysqli_query($con,$sql);
	    $rows=mysqli_fetch_assoc($result);
	    //store restaurant_id as a variable
	    $rest_id=(int)$rows['restaurant_id'];
	    //pull restaurant hours
	    $sql2="SELECT * from hours WHERE restaurant_id='".$rest_id."'";
		$result2=mysqli_query($con,$sql2);
		//when submit is hit
		if(isset($_POST["submit"])){
		//pulling from general restaurant input data user entered in
		$restaurant_name=mysqli_real_escape_string($con, $_POST['restaurant_name']);
		$phonenumber=mysqli_real_escape_string($con, $_POST['phonenumber']);
		$addressone=mysqli_real_escape_string($con, $_POST['addresslineone']);
		$addresstwo=mysqli_real_escape_string($con, $_POST['addresslinetwo']);
		$city=mysqli_real_escape_string($con, $_POST['city']);
		$state=mysqli_real_escape_string($con, $_POST['state']);
		$zip=mysqli_real_escape_string($con, $_POST['zip']);
		//first update query
		$update='UPDATE restaurant set restaurant_name="'.$restaurant_name.'",phone_number="'.$phonenumber.'", address_1="'.$addressone.'", address_2="'.$addresstwo.'",city="'.$city.'",state="'.$state.'",zip="'.$zip.'"WHERE restaurant_id="'.$rest_id.'"';
		$result3=$con->query($update);
		//pulling from hours input data user entered in
		$days1 = mysqli_real_escape_string($con, $_POST['day1']);
		// $oc1 = mysqli_real_escape_string($con, $_POST['oc1']);
		$oc1="Monday";
		$open1 = mysqli_real_escape_string($con, $_POST['start1']);
		$close1 = mysqli_real_escape_string($con, $_POST['end1']);
		
		$days2 = mysqli_real_escape_string($con, $_POST['day2']);
		// $oc2 = mysqli_real_escape_string($con, $_POST['oc2']);
		$oc2="Tuesday";
		$open2 = mysqli_real_escape_string($con, $_POST['start2']);
		$close2 = mysqli_real_escape_string($con, $_POST['end2']);
		
		$days3 = mysqli_real_escape_string($con, $_POST['day3']);
		$oc3="Wednesday";
		// $oc3 = mysqli_real_escape_string($con, $_POST['oc3']);
		$open3 = mysqli_real_escape_string($con, $_POST['start3']);
		$close3 = mysqli_real_escape_string($con, $_POST['end3']);
		
		$days4 = mysqli_real_escape_string($con, $_POST['day4']);
		// $oc4 = mysqli_real_escape_string($con, $_POST['oc4']);
		$oc4="Thursday";
		$open4 = mysqli_real_escape_string($con, $_POST['start4']);
		$close4 = mysqli_real_escape_string($con, $_POST['end4']);
		
		$days5 = mysqli_real_escape_string($con, $_POST['day5']);
		// $oc5 = mysqli_real_escape_string($con, $_POST['oc5']);
		$oc5="Friday";
		$open5 = mysqli_real_escape_string($con, $_POST['start5']);
		$close5 = mysqli_real_escape_string($con, $_POST['end5']);
		
		$days6 = mysqli_real_escape_string($con, $_POST['day6']);
		// $oc6 = mysqli_real_escape_string($con, $_POST['oc6']);
		$oc6="Saturday";
		$open6 = mysqli_real_escape_string($con, $_POST['start6']);
		$close6 = mysqli_real_escape_string($con, $_POST['end6']);
		
		$days7 = mysqli_real_escape_string($con, $_POST['day7']);
		// $oc7 = mysqli_real_escape_string($con, $_POST['oc7']);
		$oc7="Sunday";
		$open7 = mysqli_real_escape_string($con, $_POST['start7']);
		$close7 = mysqli_real_escape_string($con, $_POST['end7']);
		
		//update queries for hours and executing queries
		$update2='UPDATE hours set day="'.$days1.'",open_closed="'.$oc1.'",start_time="'.$open1.'",end_time="'.$close1.'" WHERE restaurant_id="'.$rest_id.'"AND open_closed="Monday"';
		$result4=$con->query($update2);
		
		$update3='UPDATE hours set day="'.$days2.'",open_closed="'.$oc2.'",start_time="'.$open2.'",end_time="'.$close2.'" WHERE restaurant_id="'.$rest_id.'" AND open_closed="Tuesday"';
		$result5=$con->query($update3);
		
		$update4='UPDATE hours set day="'.$days3.'",open_closed="'.$oc3.'",start_time="'.$open3.'",end_time="'.$close3.'" WHERE restaurant_id="'.$rest_id.'" AND open_closed="Wednesday"';
		$result6=$con->query($update4);
		
		$update5='UPDATE hours set day="'.$days4.'",open_closed="'.$oc4.'",start_time="'.$open4.'",end_time="'.$close4.'" WHERE restaurant_id="'.$rest_id.'" AND open_closed="Thursday"';
		$result7=$con->query($update5);
		
		$update6='UPDATE hours set day="'.$days5.'",open_closed="'.$oc5.'",start_time="'.$open5.'",end_time="'.$close5.'" WHERE restaurant_id="'.$rest_id.'" AND open_closed="Friday"';
		$result8=$con->query($update6);
		
		$update7='UPDATE hours set day="'.$days6.'",open_closed="'.$oc6.'",start_time="'.$open6.'",end_time="'.$close6.'" WHERE restaurant_id="'.$rest_id.'" AND open_closed="Saturday"';
		$result9=$con->query($update7);
		
		$update8='UPDATE hours set day="'.$days7.'",open_closed="'.$oc7.'",start_time="'.$open7.'",end_time="'.$close7.'" WHERE restaurant_id="'.$rest_id.'" AND open_closed="Sunday"';
		$result10=$con->query($update8);
		
		
		
		if ($result3 AND $result4 AND $result5 AND $result6 AND $result7 AND $result8 AND $result9 AND $result10){
		?>
		<!-- Responses -->
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Success!</strong> Your data has been updated.
		
		<?php
		}else{
		?>
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Failed!</strong> Error updating data, please try again.
		
		<!-- form for General restaurant info in input boxes -->
		<?php
			}
		}
		?>
		<div class="edit-container">
			<form method="post">
			<br>
			<center><strong><h3>Edit General Restaurant Info</h3></strong></center><br>
			Name: <input type="text" value="<?php echo $rows['restaurant_name'] ?>" name="restaurant_name"><br><br>
			Address Line 1: <input type="text" value="<?php echo $rows['address_1'] ?>" name="addresslineone"><br><br>
			Address Line 2(optional):<input type="text" value="<?php echo $rows['address_2'] ?>" name="addresslinetwo"><br><br>
			City: <input type="text" value="<?php echo $rows['city'] ?>" name="city"><br><br>
			State: <input type="text" value="<?php echo $rows['state'] ?>" name="state"><br><br>
			Zip: <input type="text" value="<?php echo $rows['zip'] ?>" name="zip"><br><br>
			Phone number:  <input type="text" value="<?php echo $rows['phone_number'] ?>" name="phonenumber"><br><br>
			<?php 
			if($rows['approved']=="N"){
				echo "Approval status: <strong>Not Approved</strong>";
			}
			else{
				echo "Approval status: <strong>Approved</strong>";
			}
			?> 
		</div>
		
		
		<!-- echoes out with out input boxes
echo '<br><strong>'. "Restaurant name:". '</strong><br><br>';
		echo $rows['restaurant_name'];
		echo "<br><br>";
		echo "<strong>Address: </strong><br><br>";
		echo $rows['address_1']." ".$rows['address_2']." ". $rows['city']. ", ". $rows['state']. " ". $rows['zip']. "<br><br>";
		echo '<strong>'. "Phone number:". '</strong><br><br>';
		echo $rows['phone_number']. "<br><br>";
 -->
		<!-- //printing out hours information in input boxes -->
		<!-- //printing out hours information in input boxes -->
		<div class="edit-container">
		<center><strong><h3>Edit hours information</h3></center></strong>
		<center><h4><strong>*Please do not enter in hours for days you are closed*</strong></h4></center> 
		<?php
		$i=1;
		if (mysqli_num_rows($result2)==0){
			echo "<strong>Restaurant has not submitted hours info</strong>";
					}
				else{
				echo "<table id='tableItems-prof' border='1'><tr><th>Open or Closed</th><th>Day</th><th>Start Time</th><th>End Time</th></tr>";
				$num_rows=mysqli_num_rows($result2);
				// var_dump($num_rows);
				while($row=mysqli_fetch_assoc($result2)){
						echo '<tr><td><input type="text" value="'. $row['day']. '"name="day'.$i.'"</td>';
						echo "<td>". $row['open_closed']."</td>";
						echo '<td><input type="text" value="'. $row['start_time']. '"name="start'.$i.'"</td>';
						echo '<td><input type="text" value="'. $row['end_time']. '"name="end'.$i.'"</td></tr>';
						$i++;
				  }	
				  echo "</table>";
				}
		?>
	</center></div>
	<div class="edit-container">
		<!-- //printing out menu in input boxes -->
		<center><strong><h3>Edit menu and allergen information</h3></center></strong>
		<?php
		$sql="SELECT * from menu_item as m, allergen as a WHERE a.restaurant_id=m.restaurant_id  AND m.menu_item_id=a.menu_item_id AND m.restaurant_id='".$rest_id."'";
		$result11=mysqli_query($con,$sql);
		if (mysqli_num_rows($result11)==0){
			echo "<strong>You have not submitted any menu information</strong><br>";
			echo "Please enter your menu information here:    ";
			echo '<a href="http://cgi.soic.indiana.edu/~team01/BO_interfaces/menu_form.html" class="contbtn">Create Menu</a>';
		}
		else{
		$i=0;
			echo "<table id='tableItems-prof' border='1'><tr><th>Category</th><th>Menu Item</th><th>Allergen</th></tr>";
		while($rows=mysqli_fetch_assoc($result11)) {
		echo '<tr><td><input type="text" name="menu['.$i.'][category]" value="'. htmlspecialchars($rows['category']). '"></td>';
		echo '<td><input type="text" name="menu['.$i.'][menu_item]" value="'. htmlspecialchars($rows['menu_item']). '"</td>'; 
    	echo '<td><input type="text" name="menu['.$i.'][allergen]" value="'. htmlspecialchars($rows['allergen']). '"</td>';
    	echo '<td><input type="hidden" name="menu['.$i.'][menu_item_id]" value="'. htmlspecialchars($rows['menu_item_id']). '"</td></tr>';
    	$i++;
		}
		}
	echo "</table>";
	// var_dump(mysqli_num_rows($result11));
	
	//menu item info
	if(isset($_POST["submit"])){
	$sql80="SELECT * from menu_item as m, allergen as a WHERE a.restaurant_id=m.restaurant_id  AND m.menu_item_id=a.menu_item_id AND m.restaurant_id='".$rest_id."'";
	$result50=mysqli_query($con,$sql80);
	$i=0;
	$all=array();
	$allergen=$rows69['allergen'];
	while($rows69=mysqli_fetch_assoc($result50)){
		array_push($all,$rows69['allergen']);
	}
		$i=0;
		// foreach ($_POST['menu'] as $menuRow) {
    	while ($i<=mysqli_num_rows($result11)){
    		${"menu_item".$i}='UPDATE menu_item SET category="'.$_POST['menu'][$i]['category'].'",menu_item="'.$_POST['menu'][$i]['menu_item'].'" WHERE menu_item_id="'.$_POST['menu'][$i]['menu_item_id'].'"';
    		${"allergen".$i}='UPDATE allergen SET allergen="'.$_POST['menu'][$i]['allergen'].'" WHERE menu_item_id="'.$_POST['menu'][$i]['menu_item_id'].'" AND allergen="'. $all[$i].'"';
    		${"menu_update".$i}=$con->query(${"menu_item".$i});
    		${"allergen_update".$i}=$con->query(${"allergen".$i});
    		$i++;
    	}	
   //  var_dump($menuRow['category']);
    // $menuRow['menu_item']
    // ...and so on
	// }
	}
	// var_dump($menu_item0);
	
	// $count=0;
	// var_dump($_POST['menu']);
		// while ($count<=mysqli_num_rows($result11)){
// 			${"category".$count}=mysqli_real_escape_string($con, $_POST['category'.$count]);
// 			$count++;
// 		}
// 		var_dump($_POST['category'.$count]);
		?>
	<input type="submit" name="submit" class="sbtn" value="Submit">
	</form>
</center></div>
    <!-- <?php endif ?> -->
</div>
</body>
</html>