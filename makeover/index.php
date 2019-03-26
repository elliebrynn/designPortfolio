<?php

if($_POST["submit"]) {
  if (empty($_POST["sender"])) {
    $nameErr = "*Please enter your name.";
  }
  if (empty($_POST["senderEmail"])) {
    $emailErr = "*Please enter your email.";
  }
  if (empty($_POST["message"])) {
    $messageErr = "*Please enter a message.<br><br>";
  }
  if ($error){
        $result="Ohh no, somethings not right... $error";
    }
  else{
    $senderEmail=$_POST["senderEmail"];
    $sender=$_POST["sender"];
    $message=$_POST["message"];
    $recipient="contact@elliebrynn.com";
    $subject="Elliebrynn.com Contact";
    $referred=$_POST["referred"];

    $mailBody="Name: $sender\nEmail: $senderEmail\nSource: $referred\n\n$message";

    mail($recipient, $subject, $mailBody, "From: $sender <$senderEmail>");

    $thankYou="<p>Thank you! Your message has been sent.</p>";
  }
}
?>

<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>
			Ellie Wojtowicz Design Portfolio
		</title>

		<!-- FONTS/ICONS -->
		<link rel="shortcut icon" href="../favicon.ico">
		<link href="https://fonts.googleapis.com/css?family=Contrail+One|Open+Sans|Shrikhand" rel="stylesheet">

		<!-- CSS -->
		<link rel="stylesheet" href="css/gridism.css">
		<link rel="stylesheet" type="text/css" href="css/styles.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />

		<!-- JS -->
		<script src="js/modernizr.custom.js"></script>
	</head>

	<body>
		<div id="fullPage" class="container">
			<div class="cbp-af-header">
				<div class="cbp-af-inner">
					<a href="http://www.elliebrynn.com"><img src="images/logo.png" alt="Ellie Wojtowicz logo"/></a>
					<nav>
            <a href="#gallery">Gallery</a>
						<a href="#about">About</a>
						<a href="">Social</a>
						<a href="/docs/EllieWojtowicz.pdf">Resume</a>
					</nav>
				</div>
			</div>
			<div class="main">
				<section id="home">
					<div>
						<p>I'M  ELLIE  WOJTOWICZ.</p>
						<h2>I believe in intentional design for social good, and people pleasing.</h2>
					</div>
				</section>
				<section id="home2">
					<div>
						<p>USER EXPERIENCE • GRAPHIC DESIGN • WEB & MOBILE DESIGN • BRANDING • DIGITAL MEDIA</p>
					</div>
				</section>
				<section id="gallery">
					<aside>
						<h3>Product Design</h3>
						<h3>Graphic Design</h3>
					</aside>
					<article>
						<h3>Gallery</h3>
						<div class="grid">
            <div class="unit one-third">
              <div class="hover">
                <a href="airbnb.html"><img src="images/airbnb/airbnbThumbnail.png" alt="Airbnb Case Study"/></a>
              </div>
            </div>
							<div class="unit one-third">
								<div class="hover">
									<a href="audible.html"><img src="images/audible/audibleUIThumbnail.png" alt="Audible Case Study"/></a>
								</div>
							</div>
							<div class="unit one-third">
								<div class="hover">
									<a href="safePlate.html"><img src="images/safePlate/safeThumbnail.png" alt="SafePlate Capstone Project"/></a>
								</div>
							</div>
							<div class="unit one-third">
								<div class="hover">
									<a href="cultivate.html"><img src="images/cultivate/cultivateThumbnail.png" alt="Cultivate Mobile UX Case Study"/></a>
								</div>
							</div>
              <div class="unit one-third">
                <div class="hover">
                  <a href="weddingInvite.html"><img src="images/wedding/weddingThumbnail.jpg" alt="Wedding Invitation Suite"/></a>
                </div>
              </div>
							<div class="unit one-third">
								<div class="hover">
									<a href="businessCards.html"><img src="images/bizCards/bizCardsThumbnail.jpg" alt="Letterpressed Business Cards"/></a>
								</div>
							</div>
              <div class="unit one-third">
								<div class="hover">
									<a href="caraLogo.html"><img src="images/CaraSingell/caraLogoThumbnail.png" alt="Logo Design"/></a>
								</div>
							</div>
							<div class="unit one-third">
								<div class="hover">
									<a href="jazzInJuly.html"><img src="images/jazzInJuly/jazzThumbnail.png" alt="Jazz In July Poster Design"/></a>
								</div>
							</div>
							<div class="unit one-third">
								<div class="hover">
									<a href="sebon.html"><img src="images/sebon/foodtruckThumbnail.png" alt="Brand Identity for Foodtruck"/></a>
								</div>
							</div>
						</div>
					</article>
				</section>
				<section id="about">
					<h3>About</h3>
          <!-- <img class="texture" src="images/1x/blueSquiggleVert.png" alt="confetti texture"/> -->
					<div class="flex-container">
						<div class="textureMe">
              <img class="texture" src="images/1x/blueSquiggleVert.png" alt="confetti texture"/>
							<img src="images/me.JPG" alt="Ellie Wojtowicz avatar"/>
						</div>
						<div class="blurb unit half">
              <h2>Get to know me!</h2>
              <p>I'm an empathetic designer passionate about creating for real people and centering my design process around their experience. People pleasing is my specialty, and I'm ready to work hard to do it right. Don't let that fool you, because a pushover is what I am not. Just a nice human.</p>
							<p>I graduated from Indiana University with a B.S. in Informatics with a cognate in graphic design but I am committed to be a lifelong learner. I crave the opportunity to add to my skill set and to develop myself by being an apprentice of experiences!
              I am currently located in Indianapolis, Indiana, and am looking for full-time employment opportunities.</p>
						</div>
					</div>
				</section>
				<section id="contact">
					<div>
						<h3>We could be great together.<br>Let's get connected!</h3>
            <img class="texture" src="images/1x/beigeSquiggleHor.png" alt="confetti texture"/>
						<!-- <h3 id="spacer">X</h3> -->
					</div>
					<div>
				    <!-- <form target="formDestination" method="post" action="index.php"> -->
            <!-- index.php#contact -->

            <!-- <form method="post" action="index.php"> -->
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

				        <input class="half" type="text" name="sender" placeholder="Name">
                <span class="error"><?php echo $nameErr;?></span>

				        <input class="half" type="text" name="senderEmail" placeholder="Email">
                <span class="error"><?php echo $emailErr;?></span>

                <input type="text" name="referred" placeholder="How did you find me?">

				        <textarea rows="5" cols="20" name="message" placeholder="What's on your mind?"></textarea>
                <span class="error"><?php echo $messageErr;?></span>

				        <input type="submit" name="submit" value="Let's Chat!">
				    </form>
            <?=$thankYou ?>
					</div>

					<!-- <div>
						<form action="mailto:contact@elliebrynn.com" method="post" enctype="text/plain">
							<input class="third" type="text" id="first_name" name="first_name" placeholder="First Name">
							<input class="third" type="text" id="last_name" name="last_name" placeholder="Last Name">
							<input class="third" type="text" id="email" name="email" placeholder="Email"><br>
							<input type="text" id="referred" name="referred" placeholder="How did you find me?">
							<textarea id="subject" name="message" placeholder="What's on your mind?" style="height:200px"></textarea><br><br>
							<input type="submit" value="Let's Chat!">
						</form>
					</div>
          <div>
            <h2>PHP Form Validation Example</h2>
            <p><span class="error">* required field</span></p>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
              Name: <input type="text" name="name">
              <span class="error">* <?php echo $nameErr;?></span>
              <br><br>
              E-mail: <input type="text" name="email">
              <span class="error">* <?php echo $emailErr;?></span>
              <br><br>
              Website: <input type="text" name="website">
              <span class="error"><?php echo $websiteErr;?></span>
              <br><br>
              Comment: <textarea name="comment" rows="5" cols="40"></textarea>
              <br><br>
              Gender:
              <input type="radio" name="gender" value="female">Female
              <input type="radio" name="gender" value="male">Male
              <input type="radio" name="gender" value="other">Other
              <span class="error">* <?php echo $genderErr;?></span>
              <br><br>
              <input type="submit" name="submit" value="Submit">
            </form>

            <?php
            echo "<p>Thank you! Your message has been sent.</p>";
            echo $thankYou;
            ?>
          </div> -->
				</section>
				<section id="social1">
					<div>
						<p>WANT TO FOLLOW ALONG? I LOVE TO BE SOCIAL.</p>
					</div>
				</section>
				<section id="social2">
					<div class="grid">
					<div class="center-on-mobiles">
						<div class="unit one-quarter">
							<a href="https://www.linkedin.com/in/thomsonellie/"><i class="fa fa-linkedin-square  fa-5x" aria-hidden="true"></i></a>
						</div>
						<div class="unit one-quarter">
							<a href="https://twitter.com/elliebrynn"><i class="fa fa-twitter  fa-5x" aria-hidden="true"></i></a>
						</div>
						<div class="unit one-quarter">
							<a href="https://www.pinterest.com/elliebrynn/"><i class="fa fa-pinterest-p  fa-5x" aria-hidden="true"></i></a>
						</div>
						<div class="unit one-quarter">
							<a href="https://www.instagram.com/elliebrynn/"><i class="fa fa-instagram  fa-5x" aria-hidden="true"></i></a>
						</div>
					</div>
					</div>
				</section>
				<section class="footer">
					<div class="grid">
					  <div class="unit half">
					  <div class="center-on-mobiles">
					  <p>© 2019 Ellie Wojtowicz</p>
					</div>
					  </div>
					  <div class="unit half">
					  	<div class="center-on-mobiles">
							<p class=" pull-right">@elliebrynn</p>
					  	</div>
					  </div>
					</div>
				</section>
			</div>
		</div>
		<!-- classie.js by @desandro: https://github.com/desandro/classie -->
		<script src="js/classie.js"></script>
		<script src="js/cbpAnimatedHeader.min.js"></script>
		<script src="https://use.fontawesome.com/a686b3c76b.js"></script>
	</body>
</html>
