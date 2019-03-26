<!-- this script works for posting a column of data from a mysql table -->
<!-- Figure out how to make each restaurant name become a variable -->
<?php
    $con=mysqli_connect("db.soic.indiana.edu","i494f17_team01","my+sql=i494f17_team01", "i494f17_team01");
    $sql="SELECT * from restaurant;";
    if($result = $con->query($sql)){
        if($count=$result->num_rows){
            echo '<p>', $count, '</p>';
        }
    } else {
    die($con->error);
    }
    $rows=$result->fetch_all(MYSQLI_ASSOC);
        $sql4="SELECT filename,image FROM restaurant"; 
$result=mysqli_query($con,$sql4);

   

    foreach($rows as $row) {
        //echo $row[0];



        //echo "<a href='$restaurant_name'>$restaurant_name</a>";
        echo '<a href="' . "newthingy.html" . '"'. '>'.$row['restaurant_name'] . '<br>'. '</a>';
        echo '<img src='.'photo/'.$row['filename'].'>';
        //echo '<a href="$image_name"><img src="'.$image.'" style=width:"' . $width . 'px;height:' . $height . 'px;"></a>';

        //how to make text into a link where you can look at the menu
    }
    

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

<HTML>

<HEAD>

<TITLE>Your Title Here</TITLE>

</HEAD>

<BODY BGCOLOR="FFFFFF">

<H1>This is a Header</H1>

<H2>This is a Medium Header</H2>

Send me mail at

support@yourcompany.com</a>.

<P> This is a new paragraph!</P>

<P> <B>This is a new paragraph!</B></P>

<B><I>This is a new sentence without a paragraph break, in bold italics.</I></B>

</BODY>

</HTML>