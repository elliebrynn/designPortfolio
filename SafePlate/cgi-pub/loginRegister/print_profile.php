<?php
	session_start();
	$con=mysqli_connect("db.soic.indiana.edu","i494f17_team01","my+sql=i494f17_team01", "i494f17_team01");

	if (!isset($_SESSION['email'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['email']);
		header("location: login.php");
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link href="css/hover-min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Concert+One|Open+Sans" rel="stylesheet">

</head>
 <div class="adminheader">
    <h1>SafePlate</h1>
</div>
<div class="header">
	<h2>Home Page</h2>
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
    <?php  if (isset($_SESSION['email'])) : ?>
    	<!-- <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
    	<p> <a href="print_profile.php?logout='1'" style="color: red;">logout</a> </p>
    	<a href="index.php" class="button">Edit</a> -->

    	<ul id="nav-ul">
			<li id="nav-li">
			    <a  id="nav-a"><?php echo $_SESSION['username']; ?></a>
			    <ul id="nav-ul" class="dropdown">
			        <li id="nav-li"><a  id="nav-a" href="print_profile.php?logout='1'">Log out</a></li>
			        <li id="nav-li"><a  id="nav-a" href="index.php">Edit info</a></li>
			    </ul>
			</li>
		</ul>


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
		?>
		<div class="overall-container">
		<div class="edit-container">
		<?php
		echo"<center><strong><h3>General Restaurant Info</h3></strong></center><br>";
		echo '<strong>'. "Restaurant name:". '</strong><br><br>';
		echo $rows['restaurant_name'];
		echo "<br><br>";
		echo "<strong>Address: </strong><br><br>";
		echo $rows['address_1']." ".$rows['address_2']." ". $rows['city']. ", ". $rows['state']. " ". $rows['zip']. "<br><br>";
		echo '<strong>'. "Phone number:". '</strong><br><br>';
		echo $rows['phone_number']. "<br><br>";
		
		
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
		<div class="table-container">
		<br><br><br><center><strong><h3>Hours information</h3></center></strong> </br> 
		<?php
		if (mysqli_num_rows($result2)==0){
				echo "<strong>Restaurant has not submitted hours info</strong>";
		}
		else{
			echo "<table id='tableItems-prof' border='1'><tr><th>Open or Closed</th><th>Day</th><th>Start Time</th><th>End Time</th></tr>";
			$num_rows=mysqli_num_rows($result2);
			// var_dump($num_rows);
			while($row=mysqli_fetch_assoc($result2)){
				if($row['day']=="Closed"){
					echo "<td><strong>". $row['day']. "</td></strong>";
					echo "<td><strong>". $row['open_closed']. "</td></strong>";
					echo "<td><strong>". "-". "</td></strong>";
					echo "<td><strong>". "-". "</td></tr></strong>";
				}
				else{
					echo "<tr><td><strong>". $row['day']. "</td></strong>";
					echo "<td><strong>". $row['open_closed']. "</td></strong>";
					echo "<td><strong>". $row['start_time']. "</td></strong>";
					echo "<td><strong>". $row['end_time']. "</td></tr></strong>";
				}
			}
					echo "</table>";
				}
		?>
	</div>
	<div class="table-container">
		<!-- //printing out menu in input boxes -->
		<br><br><br><center><strong><h3>Menu and Allergen information</h3></center></strong> </br> 
		<?php
		$sql="SELECT * from menu_item as m, allergen as a WHERE a.restaurant_id=m.restaurant_id  AND m.menu_item_id=a.menu_item_id AND m.restaurant_id='".$rest_id."'";
		$result=mysqli_query($con,$sql);
		if (mysqli_num_rows($result)==0){
		echo "<h3>Restaurant has not submitted any menu information</h3>";
		}
		else{
			echo "<table id='tableItems-prof' border='1'><tr><th>Category</th><th>Menu Item</th><th>Allergen</th></tr>";
			while($rows=mysqli_fetch_assoc($result)) {
			echo "<tr><td><strong>". $rows['category']. "</td></strong>";
			echo "<td>". $rows['menu_item']. "</td>";
    		echo "<td>". $rows['allergen']. "</td></tr>";
		}
		}
	echo "</table>";
    ?>
    <?php endif ?>
</div>
</div>
</div>
<!-- escape variables for general restaurant info -->

<!-- 
<?php 
$restaurant_name=mysqli_real_escape_string($con, $_POST['restaurant_name']);
$phonenumber=mysqli_real_escape_string($con, $_POST['phonenumber']);
$addressone=mysqli_real_escape_string($con, $_POST['addresslineone']);
$addresstwo=mysqli_real_escape_string($con, $_POST['addresslinetwo']);
$city=mysqli_real_escape_string($con, $_POST['city']);
$state=mysqli_real_escape_string($con, $_POST['state']);
$zip=mysqli_real_escape_string($con, $_POST['zip']);

// escape variable for hours info


	if(isset($_POST["submit"])){
		$update='UPDATE restaurant set restaurant_name="'.$restaurant_name.'",phone_number="'.$phonenumber.'", address_1="'.$addressone.'", address_2="'.$addresstwo.'",city="'.$city.'",state="'.$state.'",zip="'.$zip.'"WHERE restaurant_id="'.$rest_id.'"';
		if($con->query($update) === TRUE) {
		echo "Record has been update successfully\n";
		} else {
		die("Error: " . $sql . "<br>" . $con->error);
		}
	}
?>
 -->

</body>
</html>