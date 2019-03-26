<?php
session_start();
    	$con=mysqli_connect("db.soic.indiana.edu","i494f17_team01","my+sql=i494f17_team01", "i494f17_team01");
    	$rest_id2=$_GET['id'];
		$rest_id=(int)$rest_id2;
		$sql="SELECT * from restaurant WHERE restaurant_id='".$rest_id."'";
		$result=mysqli_query($con,$sql);
		$rows=mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/normalize.css">
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <link href="css/hover-min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Concert+One|Open+Sans" rel="stylesheet">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true"></script>
<script>
$(document).ready(function() {

    //exit early if no geolocation
    if(!navigator.geolocation) return;

    var destinationAddress = "<?php echo $rows['address_1'].' '.$rows['city'].', '. $rows['state'].' '. $rows['zip']; ?>";

    //our generic error handler will just give a basic message
    function handleError(e){
        $("#directionsBlock").append("<p>Sorry, we are not able to provide driving directions to the restaurant at this time.</p>");
    }
    var map;
    function gotDirections(geo){
        var directionsService = new google.maps.DirectionsService();
        var directionsDisplay = new google.maps.DirectionsRenderer();
        var myOptions = {
          mapTypeId: google.maps.MapTypeId.ROADMAP,
        }
        map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
        directionsDisplay.setPanel($("#directionsPanel")[0]);
        directionsDisplay.setMap(map);
        var youLocation = new google.maps.LatLng(geo.coords.latitude, geo.coords.longitude);

        var request = {
            origin:youLocation,
            destination:destinationAddress,
            travelMode: google.maps.TravelMode.DRIVING
        };
        directionsService.route(request, function(result, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(result);
            }
        });

    }

    $("#getMeThereButton").on("click", function() {
        navigator.geolocation.getCurrentPosition(gotDirections,handleError);
    });

    //show the button
    $("#directionsBlock").show();

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
    <div class="container">
    <!-- location -->
    <?php
    echo "<p>"; echo $rows['address_1']." ".$rows['address_2']." "; ?> </p> <p> <?php echo $rows['city']. ", ". $rows['state']. " ". $rows['zip']. "</p>";
    ?>

    <p id="directionsBlock">
    <button class="btn hvr-grow" id="getMeThereButton">Get Directions Here</button>
    <div id="directionsPanel"></div>
    </p>
    <div id="map_canvas" style="width:500px;height:500px;"></div>
  </div>
</body>
</html>
