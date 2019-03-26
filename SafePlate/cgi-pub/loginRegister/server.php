<?php
	session_start();

	// variable declaration
	// $username = "";
	$email    = "";
	$errors = array();
	$_SESSION['success'] = "";

	// connect to database
	$db = mysqli_connect("db.soic.indiana.edu","i494f17_team01","my+sql=i494f17_team01", "i494f17_team01");



	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

		$unique= "SELECT * from users where email ='".$email."'";

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		$unique_email = mysqli_query($db,$unique);
		if (mysqli_num_rows($unique_email) >= 1 ){ array_push($errors, "That email address is already in use."); }


		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database

			function ConfirmationCode($len,$code=''){
				$list ='';

				for($i=0;$i<$len;$i++){
					$code = str_shuffle($code);
					$list .=$code[0];
				}
				return $list;

			}
			$confirmCode=ConfirmationCode(8,'abdefghijklmnopqrstuvwxyuvwxyz123456789');


			$query = "INSERT INTO users (Restaurant_name, email, password, code)
					  VALUES('$username', '$email', '$password','$confirmCode')";
			mysqli_query($db, $query);




			$vlink='http://cgi.soic.indiana.edu/~team01/loginRegister/verify.php';


			$message ="Thank You for Registering with SafePlate. Please enter the following code into the {$vlink} : {$confirmCode}.";

			// mail(to,subject,body,from:)
			mail($email,"SafePlate Registration",$message,"From:safeplate01@gmail.com");

			echo "Registation Complete";


			$_SESSION['email'] = $email;
			$_SESSION['username']=$username;
			$_SESSION['success'] = "You are now logged in";
			header('location: http://cgi.soic.indiana.edu/~team01/BO_interfaces/submitV3.html');



		}

	}

	// ...

	// LOGIN USER
	if (isset($_POST['login_user'])) {
		// $username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		$email   =  mysqli_real_escape_string($db, $_POST['email']);

		if (empty($email)) {
			array_push($errors, "Email is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM users WHERE email='".$email."' AND password='".$password."'";
			$results = mysqli_query($db, $query);
			$rows=mysqli_fetch_assoc($results);

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['email'] = $email;
				$_SESSION['username'] = $rows["Restaurant_name"];
				$_SESSION['user_id']=$rows["user_id"];
				$_SESSION['success'] = "You are now logged in";
				header('location: print_profile.php');
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}


	//verify user



	if (isset($_POST['verify_user'])){
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$code = mysqli_real_escape_string($db, $_POST['code']);



		if (empty($username)) {
			array_push($errors, "Restaurant name is required");
		}
		if (empty($email)) {
			array_push($errors, "Email is required");
		}
		if (empty($code)){
			array_push($errors,"Code is Required");

		}
		if (count($errors) == 0) {

			$confirm = "SELECT * FROM users WHERE Restaurant_name='$username' AND email='$email' AND code='$code'";
			$verifyquery=mysqli_query($db,$confirm);


			if (mysqli_num_rows($verifyquery)==1){
				$verify = "UPDATE users  set verified = 'Y' where code = '$code'" ;
				$vq =mysqli_query($db,$verify);


				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now verified ";
				header('location: index.php');

			}else{
				array_push($errors, "Wrong Restaurant name/email/confirmation Code Combination");
				}
		}
	}

	///reset password
	if (isset($_POST['reset_password'])) {
	// receive all input values from the form
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
	$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);



	// form validation: ensure that the form is correctly filled
	if (empty($username)) { array_push($errors, "Username is required"); }
	if (empty($email)) { array_push($errors, "Email is required"); }
	if (empty($password_1)) { array_push($errors, "Password is required"); }

	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	}

	// rest password if there are no errors
	if (count($errors) == 0) {
		$newpassword = md5($password_1);//encrypt the password before saving in the database

		function ConfirmationCode($len,$code=''){
			$list ='';

			for($i=0;$i<$len;$i++){
				$code = str_shuffle($code);
				$list .=$code[0];
			}
			return $list;

		}
		$confirmCode=ConfirmationCode(8,'abdefghijklmnopqrstuvwxyuvwxyz123456789');


		//$query = "INSERT INTO users (Restaurant_name, email, password, code)
			//	  VALUES('$username', '$email', '$password','$confirmCode')";
		$updatequery = "UPDATE users SET password = '$newpassword' where email='$email' ";
		mysqli_query($db, $updatequery);


		$vlink='http://cgi.soic.indiana.edu/~team01/loginRegister/verify.php';


		$message ="Thank You for resetting your password. Please enter the following code into the {$vlink} : {$confirmCode}.";

		// mail(to,subject,body,from:)
		mail($email,"Resetting Your Password",$message,"From:safeplate01@gmail.com");

		echo "Reset Complete";


		$_SESSION['username'] = $username;
		$_SESSION['success'] = "You are now logged in";
		header('location: index.php');

		}

	}

	//forgot password

	if (isset($_POST['forgot_password'])){

	$email = mysqli_real_escape_string($db, $_POST['email']);



	if (empty($email)) {
		array_push($errors, "Email is required");
	}

	if (count($errors) == 0) {

		$vlink='http://cgi.soic.indiana.edu/~team01/loginRegister/reset_password.php';


		$message ="Please the link to reset your password";

		// mail(to,subject,body,from:)
		mail($email,"Resetting Your Password",$message,"From:safeplate01@gmail.com");


		}
	}

?>
