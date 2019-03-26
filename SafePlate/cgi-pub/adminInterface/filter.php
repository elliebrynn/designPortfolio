<html>
<head>
<h2>Create Custom Filter</h2>
<h3>*Allergens:</h3>
<link href="filter-style.css" rel="stylesheet" type="text/css">
</head>
<form action="user.php" method="post">
  <div>
    <input type="checkbox" id="glutenTag" name="boxsize[]" value="gluten">
    <label for="subscribeNews">Gluten</label>
  </div>
  <div>
    <input type="checkbox" id="dairyTag" name="boxsize[]" value="dairy">
    <label for="subscribeNews">Dairy</label>
  </div>
  <div>
    <input type="checkbox" id="soyTag" name="boxsize[]" value="soy">
    <label for="subscribeNews">Soy</label>
  </div>
  <div>
    <input type="checkbox" id="treenutsTag" name="boxsize[]" value="treenuts">
    <label for="subscribeNews">Tree nuts</label>
  </div>
  <div>
    <input type="checkbox" id="eggTag" name="boxsize[]" value="eggs">
    <label for="subscribeNews">Eggs</label>
  </div>
  <div>
    <input type="checkbox" id="shellfishTag" name="boxsize[]" value="shellfish">
    <label for="subscribeNews">Shellfish</label>
  </div>
  <div>
    <input type="checkbox" id="fishTag" name="boxsize[]" value="fish">
    <label for="subscribeNews">Fish</label>
  </div>
  
  <?php //$conn=mysqli_connect("localhost","root","", "allergens");
   $conn = mysqli_connect("db.soic.indiana.edu","i494f17_team01","my+sql=i494f17_team01", "i494f17_team01");
	// Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
      $ethnicity_array=[];
      $result = mysqli_query($conn,"SELECT DISTINCT ethnicity FROM ethnicity");	 	
       ?>
  
<h3>*Category</h3> 
   <select name="category[]" multiple>	<!-- ACD: ADDED [] -->
   <?php
   
   while ($row = mysqli_fetch_assoc($result)) {			 
			  echo '<option value="'.$row['ethnicity'].'">'.$row['ethnicity'].'</option>';             
  	  }

  ?>
  </select>
<!-- 
<select name="category" multiple>
  <?php
    foreach ($ethnicity_array as $ethnicity)
    {
      echo '<option value="'.$ethnicity.'">'.$ethnicity.'</option>';
    }
  ?>
 -->
<!-- </select> -->
<!-- 

<select> 
  <option value="Somolian">Somolian</option>
  <option value="Mexican">Mexican</option>
  <option value="Indian">Indian</option>
  <option value="Italian">Italian</option>
  <option value="Japanese">Japanese</option>
  <option value="Turkish">Turkish</option>
</select>
 -->
    <div>
    <input type="submit" value="Submit" style="background-color:#C0C0C0; border-style:solid;border-color:white; border-radius:8px;color:white;">
</form>
</body>
</html>