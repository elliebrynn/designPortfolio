<html>
  <head>
    <title>SafePlate Search Engine</title>
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link href="css/hover-min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Concert+One|Open+Sans" rel="stylesheet">
  </head>
  <body>
    <div class="main">
      <header>
        <h1>SafePlate</h1>
        <div class="subhead">
          <h2>A guide for somewhere safe to dine<br>&mdash; no fear of food allergens!</h2>
          <img src="images/noun_186747_cc.svg" alt="fork icon" class="fork">
          <img src="images/noun_190343_cc.svg" alt="spoon icon" class="spoon">
          <!-- “fork” and "spoon" icons by Anbileru Adaleru, from thenounproject.com. -->
        </div>
      </header>
      <section>
        <h3>Start the search by selecting your criteria below.</h3>
        <h4><small>*</small>Allergens:</h4>
        <form action="user.php" method="post" onsubmit="return checkCheckBoxes()";>
          <div>
            <input type="checkbox" id="glutenTag" name="boxsize[]" value="Gluten">
            <label for="subscribeNews">Gluten</label>
          </div>
          <div>
            <input type="checkbox" id="dairyTag" name="boxsize[]" value="Dairy">
            <label for="subscribeNews">Dairy</label>
          </div>
          <div>
            <input type="checkbox" id="soyTag" name="boxsize[]" value="Soy2">
            <label for="subscribeNews">Soy</label>
          </div>
          <div>
            <input type="checkbox" id="treenutsTag" name="boxsize[]" value="Treenuts">
            <label for="subscribeNews">Treenuts</label>
          </div>
          <div>
            <input type="checkbox" id="eggTag" name="boxsize[]" value="Eggs">
            <label for="subscribeNews">Eggs</label>
          </div>
          <div>
            <input type="checkbox" id="shellfishTag" name="boxsize[]" value="Shellfish">
            <label for="subscribeNews">Shellfish</label>
          </div>
          <div>
            <input type="checkbox" id="fishTag" name="boxsize[]" value="Fish">
            <label for="subscribeNews">Fish</label>
          </div>
          <!-- Connectivity to database -->
          <?php //$conn=mysqli_connect("localhost","root","", "allergens");
           $conn = mysqli_connect("db.soic.indiana.edu","i494f17_team01","my+sql=i494f17_team01", "i494f17_team01");
           echo '<script language="javascript">';
           echo 'alert("SafePlate is not responsible for any decisions made by our users, our results are only recommendations and from research we have done and information that restaurants have approved.")';
           echo '</script>';
          // Check connection
            if (!$conn) {
              die("Connection failed: " . mysqli_connect_error());
            }
              $ethnicity_array=[];
              $result = mysqli_query($conn,"SELECT DISTINCT ethnicity FROM ethnicity ORDER by ethnicity ASC");
           ?>
           <h4><small>*</small>Category</h4>
            <select name="category[]" multiple>	<!-- ACD: ADDED [] -->
            <?php
              while ($row = mysqli_fetch_assoc($result)) {
        			  echo '<option value="'.$row['ethnicity'].'">'.$row['ethnicity'].'</option>';
          	     }
            ?>
            </select>

            <input type="submit" value="Find Me Food!" class="btn hvr-grow">

            <script type="text/javascript" language="JavaScript">
              function checkCheckBoxes(theForm) {
                if (
                document.getElementById("glutenTag").checked == false &&
                document.getElementById("dairyTag").checked == false &&
                document.getElementById("soyTag").checked == false &&
                document.getElementById("treenutsTag").checked == false &&
                document.getElementById("eggTag").checked == false &&
                document.getElementById("shellfishTag").checked == false &&
                document.getElementById("fishTag").checked == false)
                {alert ('Please select at least one allergy!');
                  return false;
                  } else {
                    return true;
                  }
                }
              </script>

        </form>
      </section>
      <!-- background shape -->
      <div class="element"></div>
  </body>
</html>
