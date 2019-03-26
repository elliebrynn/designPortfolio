<html>
  <head>
    <title>SafePlate Search Engine</title>
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link href="css/hover-min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Concert+One|Open+Sans" rel="stylesheet">
  </head>
  <body>
		<div class="tinyHeader">
			<!-- logo small in the top left corner, new search icon in the top right. -->
			<h1>SafePlate</h1>
			<a href="filter.php" class="hvr-grow"><img src="images/noun_1285595_cc.svg" alt="Search Icon">New Search</a>
			<!-- Created by Karthick Nagarajan from the Noun Project -->
		</div>
		<?php
			session_start();
		    $con=mysqli_connect("db.soic.indiana.edu","i494f17_team01","my+sql=i494f17_team01", "i494f17_team01");
		    $rest_id2=$_GET['id'];
			$rest_id=(int)$rest_id2;
			// var_dump($rest_id);
			$sql="SELECT * FROM restaurant WHERE restaurant_id='".$rest_id."'";
			$result=mysqli_query($con,$sql);
			$rows=mysqli_fetch_assoc($result);
			$ethn="SELECT ethnicity FROM ethnicity WHERE restaurant_id='".$rest_id."'";
			$ethn_result=mysqli_query($con,$ethn);
			$ethn_rows=mysqli_fetch_assoc($ethn_result);
      ?>
      <div class="title">
        <h2 class="center">
        <?php echo $rows['restaurant_name']; echo "</h2>";
        echo "<h3 class='center'>"; echo $ethn_rows['ethnicity']; echo "</h3>";?>
      </div>
        <div class="rightSide">
          <div class="profPic">
            <?php echo '<img src='.'http://cgi.soic.indiana.edu/~team01/BO_interfaces/photo/'.$rows['filename'].'>';?>
          </div>
          <?php echo '<br><a href="' . "custom_menu.php?id=" .$rows['restaurant_id']. '"'. 'class="hvr-grow">'."SafePlate Custom Menu" . '</a>';?>
        </div>
        <div class="leftSide">
        <?php

				echo "<h4 class='leftMargPad'> Address: </h4>";
				echo "<p class='leftMargPad'>"; echo $rows['address_1']." ".$rows['address_2']." "; ?> </p> <p class='leftMargPad'> <?php echo $rows['city']. ", ". $rows['state']. " ". $rows['zip']. "</p>";
				echo '<a href="' . "https://cgi.soic.indiana.edu/~team01/userInterfaces/maptest.php?id=" .$rows['restaurant_id']. '"'. ' class="hvr-grow leftMargPad">'."Get Directions" . '</a>';
				echo "<h4 class='leftMargPad'>". "Phone number:". '</h4>';
				echo "<p class='leftMargPad'>"; echo $rows['phone_number']; echo "</p>";
				//hours table
				$sql2="SELECT * from hours WHERE restaurant_id='".$rest_id."'";
				$result2=mysqli_query($con,$sql2);
				// $row=mysqli_fetch_assoc($result2);
				if (mysqli_num_rows($result2)==0){
						echo "<strong>Restaurant has not submitted hours info</strong>";
					}
				else{
				echo "<table class='leftMargPad'><tr><th>Open or Closed</th><th>Day</th><th>Start Time</th><th>End Time</th></tr>";
				$num_rows=mysqli_num_rows($result2);
				// var_dump($num_rows);
				while($row=mysqli_fetch_assoc($result2)){
					if($row['day']=="Closed"){
						echo "<td>". $row['day']. "</td>";
						echo "<td>". $row['open_closed']. "</td>";
						echo "<td>". "-". "</td>";
						echo "<td>". "-". "</td></tr>";
					}
					else{
						echo "<tr><td>". $row['day']. "</td>";
						echo "<td>". $row['open_closed']. "</td>";
						echo "<td>". $row['start_time']. "</td>";
						echo "<td>". $row['end_time']. "</td></tr>";
					}
				}
				}
			    // var_dump(mysqli_num_rows($result2));
			       ?>
      </div>
		<div class="element"></div>
	</body>
</html>
