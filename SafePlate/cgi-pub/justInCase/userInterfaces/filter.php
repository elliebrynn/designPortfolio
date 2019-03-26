<html>
  <head>
    <title>Restaurant Search Engine for Users</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link href="css/hover-min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Concert+One|Open+Sans" rel="stylesheet">
  </head>
  <body>
    <div class="main">
      <header>
        <h1>SafePlate</h1>
        <h2>A guide for somewhere safe to dine<br>&mdash; no fear of food allergens!</h2>
        <img src="images/noun_186747_cc.svg" alt="fork icon" class="fork">
        <img src="images/noun_190343_cc.svg" alt="spoon icon" class="spoon">
        <!-- “fork” and "spoon" icons by Anbileru Adaleru, from thenounproject.com. -->
      </header>
      <div class="subhead">
        <h2>Start your search. You can be in control.</h2>
        <h3>*Allergens:</h3>
      </div>
      <form action="user.php" method="post">
        <div>
          <input type="checkbox" id="glutenTag" name="Gluten" value="gluten">
          <label for="subscribeNews">Gluten</label>
        </div>
        <div>
          <input type="checkbox" id="dairyTag" name="dairy" value="dairy">
          <label for="subscribeNews">Dairy</label>
        </div>
        <div>
          <input type="checkbox" id="soyTag" name="Soy" value="soy">
          <label for="subscribeNews">Soy</label>
        </div>
        <div>
          <input type="checkbox" id="treenutsTag" name="Treenuts" value="treenuts">
          <label for="subscribeNews">Tree nuts</label>
        </div>
        <div>
          <input type="checkbox" id="eggTag" name="eggs" value="eggs">
          <label for="subscribeNews">Eggs</label>
        </div>
        <div>
          <input type="checkbox" id="shellfishTag" name="Shellfish" value="shellfish">
          <label for="subscribeNews">Shellfish</label>
        </div>
        <div>
          <input type="checkbox" id="fishTag" name="Fish" value="fish">
          <label for="subscribeNews">Fish</label>
        </div>
      <h3>*Category</h3>

      <!-- Connectivity to database -->
      <?php
              $conn = mysqli_connect("db.soic.indiana.edu","i494f17_team01","my+sql=i494f17_team01", "i494f17_team01");
              // Check connection
              if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
              }
                $result = mysqli_query($conn,"SELECT DISTINCT restaurant_id, ethnicity FROM ethnicity");
                while ($row = mysqli_fetch_assoc($result)) {
                        unset($restaurantID, $ethnicity);
                        $restaurantID = $row['restaurant_id'];
                        $ethnicity = $row['ethnicity'];
                        echo '<option value="'.$ethnicity.'">'.$ethnicity.'</option>';
            }
      ?>

      <select>
        <option value="Somolian">Somolian</option>
        <option value="Mexican">Mexican</option>
        <option value="Indian">Indian</option>
        <option value="Italian">Italian</option>
        <option value="Japanese">Japanese</option>
        <option value="Turkish">Turkish</option>
      </select>
          <div>
          <input type="submit" value="Submit" class="btn hvr-grow">
      </form>
      <!-- background shape -->
      <div class="element"></div>
  </body>
</html>
