
<?php
if(isset($_POST['search'])){
    if (!empty($RequiredLocation) &&!empty($CurrentLocation) ){
?>

<div class='content'>  <!--from .... To .... box  -->
    <div class='stoplabel'>
        <img src="images/road.png" style="width: 50px;height: 50px;">	<span style='font-size:28px ; color:black; ' class='formlabel'>
   From <span style='color:#a94442' ><?php echo $CurrentLocation ?> </span> To   <span style='color:#a94442' >
	   <?php echo $RequiredLocation ?></span> Road
    </div>
</div>


<?php
    $id1=mysqli_query($Connection,"SELECT city_id FROM city WHERE city_name='$CurrentLocation'");
    $id2=mysqli_query($Connection,"SELECT city_id FROM city WHERE city_name='$RequiredLocation'");

    while($DataRows1=mysqli_fetch_array($id1)){
        $StartId =$DataRows1['city_id'];
    }
    while($DataRows2=mysqli_fetch_array($id2)){
        $ArriveId =$DataRows2['city_id'];
    }
?>
    <div class='table-responsive'>
        <table class='table table-hover table-striped'>
            <tr>
                <th>From</th>
                <th>To</th>
                <th>Depart Time</th>
                <th>Superjet ID</th>
            </tr>

            <?php
            $result=mysqli_query($Connection,"SELECT depart_time, _id FROM scedule WHERE _from='$StartId' AND _to='$ArriveId'");

            while ($DataRaws=mysqli_fetch_array($result)){
            $id=$DataRaws['_id'];
            $depart_time=$DataRaws['depart_time'];

            ?>

            <tr>
                <td><?php echo $CurrentLocation; ?></td>
                <td><?php echo $RequiredLocation; ?></td>
                <td><?php echo $depart_time; ?></td>
                <td><?php echo $id; ?></td>
            </tr>

            <?php
            }

            ?>
        </table>
    </div>

<?php
}else{
   // echo "<h3>Please add Current location and Required location</h3>";
}}
?>
<br>

<div class='facebook-comment' style='width: 80%; margin: 0 auto;' >
  <?php $SearchValues=$CurrentLocation.'to'.$RequiredLocation ?>
<div class="fb-comments" data-href="http://localhost/pathway/index2.php?search=<?php echo $SearchValues ?>" data-numposts="5" width="100%">
</div>
</div>
