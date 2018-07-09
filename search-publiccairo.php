
<?php
if(isset($_POST['search'])){
    if (!empty($RequiredLocation) &&!empty($CurrentLocation)){

		?>

	  <div class='content'>  <!--from .... To .... box  -->
      <div class='stoplabel'>
	  <img src="images/road.png" style="width: 50px;height: 50px;">	<span style='font-size:28px ; color:black; ' class='formlabel'>
   From<span style='color:#a94442' ><?php echo $CurrentLocation ?> </span> To   <span style='color:#a94442' >
	   <?php echo $RequiredLocation ?></span> Road
	  </div>
	 </div>



<?php
    $id1=mysqli_query($Connection,"SELECT _id FROM area WHERE name='$CurrentLocation'");
    $id2=mysqli_query($Connection,"SELECT _id FROM area WHERE name='$RequiredLocation'");

    while($DataRows1=mysqli_fetch_array($id1)){
        $StartId =$DataRows1['_id'];

    }
    while($DataRows2=mysqli_fetch_array($id2)){
        $ArriveId =$DataRows2['_id'];
    }
?>
    <div class='table-responsive'>
        <table class='table table-hover table-striped'>
            <tr>
                <th>From</th>
                <th>To</th>
                <th>Line Number</th>
              <!--  <th>Superjet ID</th> -->
            </tr>

            <?php
            $result1=mysqli_query($Connection,"SELECT f.line_num as line_num /*,
                                  f.ordering as from_order, t.ordering as to_order */ FROM ordering f,
                                  ordering t WHERE f.area_id='$StartId' AND t.area_id='$ArriveId' AND f.line_num=t.line_num");
            if($result1===false){
                echo "false";
            }
            $f_line_num_array=array();
            while ($DataRaws=mysqli_fetch_array($result1)) {
                $f_line_num = $DataRaws['line_num'];
                $f_line_num_array[]=$DataRaws['line_num'];
          //    $f_ordering = $DataRaws['from_order'];
          //    $t_ordering = $DataRaws['to_order'];
            }
            if($f_line_num !=null){
                $result2=mysqli_query($Connection,"SELECT id, fromarea, toarea FROM line WHERE num='$f_line_num'");

                while ($DataRaws=mysqli_fetch_array($result2)) {
                    $line_id = $DataRaws['id'];
                    $fromarea_id = $DataRaws['fromarea'];
                    $toarea_id = $DataRaws['toarea'];
                }

                /*    $result3=mysqli_query($Connection,"SELECT name FROM aera WHERE _id='$fromarea_id'");
                    while ($DataRaws1=mysqli_fetch_array($result3)){
                        $fromarea_name = $DataRaws1['name'];
                    }
                    $result4=mysqli_query($Connection,"SELECT name FROM aera WHERE _id='$toarea_id'");
                    while ($DataRaws2=mysqli_fetch_array($result4)){
                        $toarea_name = $DataRaws2['name'];
                    }
                */
                $area_name_array=array();
                $result5=mysqli_query($Connection,"SELECT /* o.area_id, */ a.name as area_name FROM ordering o, area a WHERE o.line_num='$f_line_num' AND o.area_id=a._id");
                while ($DataRaws3=mysqli_fetch_array($result5)){
                    //$o_area_id = $DataRaws3['o.area_id'];
                    $area_name_array[] = $DataRaws3['area_name'];
                }
            }else{
                echo "No Direct Line";

            }
          ?>


            <div class='content'>
                <div class='stoplabel'>
                    <img src="images/bus-stop.png" style="width: 50px;height: 50px;">
                    <span style='font-size:28px;  color:#a94442;' class='formlabel'>Bus Found on Bus line :
                        <?php  foreach( $f_line_num_array as $line_num): ?>
                            <span id='trainline'> <?= $line_num  ?> </span>
                        <?php endforeach;  ?>
	                      </span>
                    <br>

                    <ul class='station-list'> <!-- print stations graph-->
                        <?php $id=1;  foreach( $area_name_array as $area_name): ?>
                            <?php if ($CurrentLocation == $area_name || $RequiredLocation==$area_name) { ?>
                                <li class='station' style='background:#a94442 ; '><?php echo $id; $id++; ?> </li>
                                <span id='station' style='text-decoration: underline;'><?= $area_name ?> </span>
                            <?php  } else{ ?>

                                <li class='station'><?php echo $id; $id++; ?> </li>
                                <span id='station'><?= $area_name ?> </span>
                            <?php } endforeach; ?>
                    </ul>
                </div>
            </div>



            <tr>
                <td><?php echo $CurrentLocation; ?></td>
                <td><?php echo $RequiredLocation; ?></td>
                <td><?php echo $f_line_num; ?></td>
               <!-- <td><?php echo $id; ?></td> -->
            </tr>

            <?php


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
