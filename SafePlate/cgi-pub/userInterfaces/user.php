<?php
			session_start();
			$con=mysqli_connect("db.soic.indiana.edu","i494f17_team01","my+sql=i494f17_team01", "i494f17_team01");
			//$con=mysqli_connect("localhost","root","", "allergens");
			// Check connection

			// var_dump($_POST);

			if (mysqli_connect_errno())
			{echo nl2br("Failed to connect to MySQL: " . mysqli_connect_error() . "\n "); }
			else
			// { echo nl2br("Established Database Connection \n");}
			//escape variables for allergen
			$allergens=mysqli_real_escape_string($con,implode(" ",$_REQUEST["boxsize"]));
			// var_dump(str_word_count($allergens));
			$_SESSION["allergens"]=$allergens;
			$ethnicities = mysqli_real_escape_string($con,implode(" ",$_POST['category']));
			//sql select query
			?>
<html>
  <head>
    <title>SafePlate Search Engine</title>
		<!-- stylesheets -->
		<link rel="stylesheet" type="text/css" href="tooltipster/dist/css/tooltipster.bundle.min.css" />
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <link href="css/hover-min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css?family=Concert+One|Open+Sans" rel="stylesheet">
		<!-- js for tooltipster -->
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
    <script type="text/javascript" src="tooltipster/dist/js/tooltipster.bundle.min.js"></script>
		<script>
        $(document).ready(function() {
            $('.tooltip').tooltipster(
							{
							   animation: 'fade',
							   delay: 200,
							   theme: 'tooltipster-noir'
							});
        });
    </script>
	</head>
  <body>
		<div class="tinyHeader">
			<!-- logo small in the top left corner, new search icon in the top right. -->
			<h1>SafePlate</h1>
			<a href="filter.php" class="hvr-grow"><img src="images/noun_1285595_cc.svg" alt="Search Icon">New Search</a>
			<!-- Created by Karthick Nagarajan from the Noun Project -->
		</div>
		<?php 
		$i=0;
		$exp=explode(" ",$allergens);
		$exp1=explode(" ",$ethnicities);
		
			?>
		<div class="main">
			<h2 class="sideBars"><?php echo " ";
			while ($i<str_word_count($ethnicities)){
				if ($i==str_word_count($ethnicities)-1){
					echo $exp1[$i];
				}
				if ($i<str_word_count($ethnicities)-1){
					echo $exp1[$i].", ";
				}
				$i++;
			}
			$i=0;
			echo " locations with options free from ";
			while ($i<str_word_count($allergens)){
				if ($exp[$i]=="Soy2"){
					$exp[$i]="Soy";
				}
				if ($i==str_word_count($allergens)-1){
					echo $exp[$i];
				}
				if ($i<str_word_count($allergens)-1){
					echo $exp[$i].", ";
				}
				$i++;
			} 
			?></h2>
			<?php
			$sql="SELECT a.restaurant_id, r.restaurant_name, count(DISTINCT a.menu_item_id) as count,(SELECT DISTINCT COUNT(menu_item_id) FROM menu_item WHERE restaurant_id=a.restaurant_id) as total,(count(DISTINCT a.menu_item_id)/(SELECT COUNT(menu_item_id) FROM menu_item WHERE restaurant_id=a.restaurant_id)) as perc
	 		FROM allergen as a
				 LEFT JOIN restaurant as r on a.restaurant_id=r.restaurant_id
				 LEFT JOIN ethnicity as e on a.restaurant_id=e.restaurant_id AND MATCH (e.ethnicity) AGAINST ('".$ethnicities."' IN BOOLEAN MODE)
	 		WHERE a.menu_item_id NOT IN (SELECT menu_item_id FROM allergen WHERE MATCH (allergen) AGAINST ('".$allergens."' IN BOOLEAN MODE)) AND MATCH (e.ethnicity) AGAINST ('".$ethnicities."' IN BOOLEAN MODE) AND approved='Y'
	 		GROUP BY a.restaurant_id
	 		ORDER BY perc DESC";
				 ?>

			<div class="resultList">
			<?php
			$result = $con->query($sql);
			if (mysqli_num_rows($result)==0){
			echo "<strong> No results</strong>";
			}
			else{
				while ($row=mysqli_fetch_assoc($result)){
				?>
 				<div class="resultCard hvr-grow">
	 				<?php
					echo '<a href="' . "restprof.php?id=" .$row['restaurant_id']. '"'.">".$row['restaurant_name']." </a>";
					?>
					<!-- INCLUDING COUNT .$row['restaurant_name']." ". $row['count'] . "<br></a>"; -->
					<!-- JUST RESTAURANT NAME .$row['restaurant_id']. '"'."/a>".$row['restaurant_name']." ". "<br></a>"; -->
					<div class="restaurantInfo">
						<h2 class="tooltip" title="This value indicates what percentage of the restaurant's menu accomodates your specific needs."><?php echo (round($row['perc'], 2) * 100)?>%</h2>
						<h3>menu safety rating</h3>
					</div>
				</div>
				<?php
				}
			}
			?>
			</div>
			<?php

			mysqli_close($con);
			?>
			</div>
		<div class="element"></div>
	</body>
</html>
