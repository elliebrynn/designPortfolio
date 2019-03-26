<?php
	if(isset($_POST['deny'])){
		$comments = mysqli_real_escape_string($db,$_POST['comments']);

	//pass form data dont use session
	//move to adminform.php
	//grab rest id from rest table and use it to pull email from users table

	//query to update restaurant column 
		$query = "UPDATE restaurant set comments = '$comments' from restaurant , users where users.email= $email";

		

		// $query = "INSERT INTO comments (comments,restaurant,email) values ('$comments','$restaurant','$email')";
		// mysqli_query($db,$query);


		//send an email to the restaurant that their menu has been denied.
		$message ="your menu has been denied by SafePlate's Admin Team. they made the followwing comments: {$comments} .";

			// mail(to,subject,body,from:)
			mail($email,"An Important message from the SafePlate Admin Team",$message,"From:safeplate01@gmail.com");

			echo "works";
		}


		if (isset($_POST['approve'])){
		//if the restaurant's menu is approved, update the approved column in the restaurant table

			$updatequery = "UPDATE restaurant SET approved = 'Y' where user_id='$user_id' ";
			mysqli_query($updatequery);
			$message ="your menu has been Approved by SafePlate's Admin Team.";

				// mail(to,subject,body,from:)
				mail($email,"An Important message from the SafePlate Admin Team",$message,"From:safeplate01@gmail.com");

				echo "approved";
		}

	


?>