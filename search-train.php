
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
		$id=0;
//get the ids of start & arrive stations
		$id1=mysqli_query($Connection,"select _id from station where stationname='$CurrentLocation' or stationarabic='$CurrentLocation'");
		$id2=mysqli_query($Connection,"select _id from station where stationname='$RequiredLocation' or stationarabic='$RequiredLocation'");
		while($DataRows1=mysqli_fetch_array($id1)){
            $StartId =$DataRows1['_id'];
		}
		while($DataRows2=mysqli_fetch_array($id2)){
			$ArriveId =$DataRows2['_id'];
		}
//get the same train-line of the start& arrive stations
		$trainlinequery=mysqli_query($Connection,"select from_order.trainlineid FROM stationorder from_order inner join stationorder to_order
		on from_order.trainlineid=to_order.trainlineid where from_order.stationid='$StartId' and to_order.stationid='$ArriveId'
		and from_order.ordering < to_order.ordering");
		$TrainLines = array();
		while($DataRows=mysqli_fetch_array($trainlinequery)){
		$TrainLineId=$DataRows['trainlineid'];
		$TrainLines[]=$DataRows['trainlineid'];
		}
		if ( count($TrainLines)!==0){ //check for found  'train-lines' or not
// stations in the same trainline
    $StationsArray = array();//array of stations in the line
		$ExcuteQuery=mysqli_query($Connection,"select stationid from stationorder  where trainlineid='$TrainLineId' order by ordering asc ");
		while($DataRows=mysqli_fetch_array($ExcuteQuery)){
		$StationId=$DataRows['stationid'];
		$ExcuteQuery2=mysqli_query($Connection,"select stationname,stationarabic from station  where _id ='$StationId' ");
		while($DataRows=mysqli_fetch_array($ExcuteQuery2)){
		$StationsArray[]=$DataRows['stationname'];
		}}
  	}else {echo 'no trainlines for this two station';}


//view travel detials  query
$ViewQuery="
select tv._id,tv.fk_trainid as trainid,TIME(tv.starttime) as starttime ,TIME(tv.arrivetime) as arrivetime ,
tr.trainnumber as trainnumber,tr.fk_trainlineid,p.First_price as firstprice,p.Second_price as secondprice ,
tp.type as trollytype , ws.state as workingstate
from travel tv ,train tr , trolleytype tp ,workingstate ws ,trainline tl ,price p
where FK_StartStationID='$StartId' and FK_arriveStationID='$ArriveId'
and tv.fk_trainid =tr._id and tr.fk_trolleytypeid=tp._id and tr.fk_workingstate=ws._id  and tr.FK_TrainLineID = tl._id and tr.trainnumber=p.train_number
group by starttime
order by arrivetime asc

    ";

    ?>
      <div class='content'>
      <div class='stoplabel'><!--print trainline stations in the same trainline -->
	  <img src="images/train-stop.png" style="width: 50px;height: 50px;">
	  <span style='font-size:28px;  color:#a94442;' class='formlabel'>Train Found on Train line :
	  <?php foreach( $TrainLines as $TrainLine): ?>
    <span id='trainline'> <?= $TrainLine  ?> </span>
      <?php endforeach; ?>
	  </span>
	  <br>

    <ul class='station-list'> <!-- print stations graph-->
	  <?php $id=1;  foreach( $StationsArray as $Station): ?>
	  <?php if ($CurrentLocation == $Station || $RequiredLocation==$Station) { ?>
      <li class='station' style='background:#a94442 ; '><?php echo $id; $id++; ?> </li>
      <span id='station' style='text-decoration: underline;'><?= $Station ?> </span>
   	<?php  } else{ ?>
	  <li class='station'><?php echo $id; $id++; ?> </li>
	  <span id='station'><?= $Station ?> </span>
  	<?php } endforeach; ?>
      </ul>
        </div>
       </div>


		 <div class='table-responsive'>
      <table class='table table-hover table-striped'>
	    <tr>
		  <th>  id </th>
		  <th>  TrainNumber </th>
		  <th>  StartTime </th>
		  <th>  ArriveTime </th>
		  <th>  TrollType </th>
		  <th>  WorkingState </th>
		  <th>  First Price </th>
		  <th>  Second Price </th>
	  	</tr>
		<?php
    $ExcuteQuery3=mysqli_query($Connection,$ViewQuery);

	 while($DataRows=mysqli_fetch_array($ExcuteQuery3)){
		 if( sizeof($DataRows) >0){ //chech for results

				$id++;
			   $TrainNumber=$DataRows['trainnumber'];
			   $StartTime =$DataRows['starttime'];
			   $ArriveTime=$DataRows['arrivetime'];
			   $StartTime =$DataRows['starttime'];
         $ArriveTime=$DataRows['arrivetime'];
			   $TrollType=$DataRows['trollytype'];
			   $WorkingState=$DataRows['workingstate'];
			   $First_price=$DataRows['firstprice'];
         $Second_price=$DataRows['secondprice'];
	   ?>

         <tr>	<!-- table data fill with search  -->
         <td><?php echo $id ?></td>
		    <td><?php echo $TrainNumber ?></td>
	   	 <td><?php echo $StartTime ?></td>
		   <td><?php echo $ArriveTime ?></td>
	  	 <td><?php echo $TrollType ?></td>
		   <td><?php echo $WorkingState ?></td>
		  <td><?php echo $First_price ?></td>
		  <td><?php echo $Second_price ?></td>

	    </tr>

<?php
 }}
?>
</table>
</div>
<?php


	}else{
            $CurrentLocationError="<br>"."<div class='alert-empty'>".'<span class="glyphicon glyphicon-warning-sign"></span>';
            $CurrentLocationError.=" Please ALL Empty Fields ".'</div>';
}

	}
  ?>
  <br>
  <div class='facebook-comment' style='width: 80%; margin: 0 auto;' >
    <?php $SearchValues=$CurrentLocation.'to'.$RequiredLocation ?>
  <div class="fb-comments" data-href="http://localhost/pathway/index2.php?search=<?php echo $SearchValues ?>" data-numposts="5" width="100%">
  </div>
  </div>
