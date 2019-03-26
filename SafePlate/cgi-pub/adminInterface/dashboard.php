<HTML>

<head>
    <title>Admin Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css?family=Concert+One" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

        <meta http-equiv="x-ua-compatible" content="ie=edge">


        <!-- Stylesheets -->
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all">
        <link href="css/hover-min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/normalize.css">

        <!-- script -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


        <!--[if lt IE 9]>
            <script src="components/html5shiv/html5shiv.min.js"></script>
        <![endif]-->
</head>

<BODY>
 <div class="adminheader">
    <h1>SafePlate</a></h1>
</div>

 <ul id="nav-ul">
                <li id="nav-li">
                    <a  id="nav-a">admin</a>
                    <ul id="nav-ul" class="dropdown">
                        <li id="nav-li"><a  id="nav-a" href="http://cgi.soic.indiana.edu/~team01/adminInterface/login.php">Log out</a></li>
                    </ul>
                </li>
            </ul>


        <!-- <img src="images/rest1.jpg" alt="rest prof pic" class="profpic"> -->
        <div class='container' id='allSection'>
          <!-- this script works for posting a column of data from a mysql table -->
          <!-- Figure out how to make each restaurant name become a variable -->
          <?php

              $con=mysqli_connect("db.soic.indiana.edu","i494f17_team01","my+sql=i494f17_team01", "i494f17_team01");
              $sql="SELECT * from restaurant WHERE approved='N'";
              if($result = $con->query($sql)){
                  if($count=$result->num_rows){
                      echo '<p>', $count, ' unapproved restaurants:</p>';
                  }
              } else {
              die($con->error);
              }
              $rows=$result->fetch_all(MYSQLI_ASSOC);
                  $sql4="SELECT filename,image FROM restaurant";
          $result=mysqli_query($con,$sql4);

          ?>
            <ul>
            <?php
                foreach($rows as $row) {
                    //echo $row[0];
                ?>
                <li>

                    <br>
                    <div id="profpic">
                          <div class='restView'>
                    <?php
                        //echo "<a href='$restaurant_name'>$restaurant_name</a>";
                        echo '<a href="' . "adminform.php?id=" .$row['restaurant_id']. '"'. '>'.$row['restaurant_name'] . '<br>'. '</a>';
                    ?>
                </div>
                    <?php
                        echo '<img src='.'http://cgi.soic.indiana.edu/~team01/BO_interfaces/photo/'.$row['filename'].'>';
                        //echo '<a href="$image_name"><img src="'.$image.'" style=width:"' . $width . 'px;height:' . $height . 'px;"></a>';

                        //how to make text into a link where you can look at the menu
                     }
                    ?></div></li>
                    </div>
            </div>
            </ul>
        </div>

        <div class="element"></div>

</BODY>

</HTML>

<!-- this script works for posting a column of data from a mysql table -->
<!-- Figure out how to make each restaurant name become a variable -->

<?php

    //echo '<img src=photo/taco.png height="100" width="100">';
//select image, rest_name from rest
    //where rest_id = "here"
$sqlimage  = "SELECT filename, image FROM restaurant where id = 147";
$imageresult1 = mysql_query($con,$sqlimage);

while($rows=mysql_fetch_assoc($imageresult1))
{
    $image = $rows['image'];
    echo '<img src="photo/'.$image.'" />';
    echo "<br>";
}


    // echo '<pre>', print_r($rows), '<pre>';



    // $result=mysqli_query($con,$sql);
//  if($result = mysqli_query($con, $sql)){
   //  if(mysqli_num_rows($result) > 0){
    // $resultCheck=mysqli_num_rows($result);
//  if ($resultCheck > 0) {
//      while ($row=mysqli_fetch_assoc($result)){
//          echo $row['restaurant_name'] . "<br";
//      }
//  }
?>
