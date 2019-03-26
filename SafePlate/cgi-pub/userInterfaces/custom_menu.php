<!-- connect to db -->
		<?php
		session_start();
    	$con=mysqli_connect("db.soic.indiana.edu","i494f17_team01","my+sql=i494f17_team01", "i494f17_team01");
    	$rest_id2=$_GET['id'];
		$rest_id=(int)$rest_id2;
		$sql2="SELECT restaurant_name from restaurant WHERE restaurant_id='".$rest_id."'";
		$result2=mysqli_query($con,$sql2);
		$name=mysqli_fetch_assoc($result2);
			// var_dump($rest_id);
		?>
<html>
  <head>
    <title>Customized Menu</title>
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
		<div class="mainMenu">
			<h2>
			<?php echo $name['restaurant_name']. " Menu";?></h2>
			<h3>Currently displaying menu items not containing:</h3>
			<h3><?php $allergens=$_SESSION['allergens']; 
			$exp=explode(" ",$allergens);
			$i=0;	
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
			}?>
			</h3>
			<article>
				<?php
					$sql="SELECT DISTINCT m.category,m.menu_item,m.menu_item_id,a.allergen from menu_item as m, allergen as a WHERE a.restaurant_id=m.restaurant_id  AND m.menu_item_id=a.menu_item_id AND m.restaurant_id='".$rest_id."' AND a.menu_item_id NOT IN (SELECT menu_item_id FROM allergen WHERE MATCH (allergen) AGAINST ('".$allergens."' IN BOOLEAN MODE))";
				echo "<table><tr><th>Category</th><th>Menu Item</th><th>Allergen</th></tr>";
				$result=mysqli_query($con,$sql);
				// $priorCategory = [];
				// $priorItem=[];
				while($rows=mysqli_fetch_assoc($result)) {
					// if (!in_array($rows['category'],$priorCategory)) {
					echo "<tr><td><strong>". $rows['category']. "</td></strong>";
					// $priorCategory[]=$rows['category'];
					// }
					// if (!in_array($rows['menu_item_id'],$priorItem)){
					echo "<td>". $rows['menu_item']. "</td>";
					// $priorItem[]=$rows['menu_item_id'];
    				// }
    				$allergen=$rows['allergen'];
    				if($rows['allergen']=="Soy2"){
    				$allergen="Soy";
    				}
   					 echo "<td>". $allergen. "</td></tr>";
					}
					echo "</table>";
				?>
			</article>
		</div>
	</body>
</html>
