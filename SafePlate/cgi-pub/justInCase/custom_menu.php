<html>
  <head>
    <title>Restaurant Search Engine for Users</title>
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link href="css/hover-min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Concert+One|Open+Sans" rel="stylesheet">
  </head>
  <body>
    <div class="weirdColor">
			<?php
				session_start();
	    	$con=mysqli_connect("db.soic.indiana.edu","i494f17_team01","my+sql=i494f17_team01", "i494f17_team01");
	    	$rest_id2=$_GET['id'];
				$rest_id=(int)$rest_id2;
				var_dump($rest_id);
				$allergens=$_SESSION['allergens'];
				echo $allergens;
				$sql="SELECT DISTINCT m.category,m.menu_item,m.menu_item_id,a.allergen from menu_item as m, allergen as a WHERE a.restaurant_id=m.restaurant_id  AND m.menu_item_id=a.menu_item_id AND m.restaurant_id='".$rest_id."' AND a.menu_item_id NOT IN (SELECT menu_item_id FROM allergen WHERE MATCH (allergen) AGAINST ('".$allergens."' IN BOOLEAN MODE))";
				echo "<table border='1' cellpadding='10'><tr><th>Category</th><th>Menu Item</th><th>Allergen</th></tr>";
				$result=mysqli_query($con,$sql);
				// $priorCategory = [];
				// $priorItem=[];
				while($rows=mysqli_fetch_assoc($result)) {
					// if (!in_array($rows['category'],$priorCategory)) {
					echo "<tr><td><strong>". $rows['category']. "</td></strong><br>";
					// $priorCategory[]=$rows['category'];
					// }
					// if (!in_array($rows['menu_item_id'],$priorItem)){
					echo "<td>". $rows['menu_item']. "</td><br>";
					// $priorItem[]=$rows['menu_item_id'];
	    		// }
	    		echo "<td>". $rows['allergen']. "</td></tr><br>";
					}
				echo "</table>";
			?>
		</div>
	</body>
</html>
