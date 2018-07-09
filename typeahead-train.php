<?php
	$mysqli =  mysqli_connect('localhost', 'root','','traindb');
	mysqli_set_charset($mysqli,"utf8");
	$Query = $_GET['query'];
	$sql = "SELECT DISTINCT * FROM station 
			WHERE stationname  LIKE '%".$_GET['query']."%' OR stationarabic  LIKE '%".$_GET['query']."%'
	
			 "; 
	$result = mysqli_query($mysqli,$sql);	
	$json = [];
	while($row = $result->fetch_assoc()){
	     $json[] = $row['stationname'];
		 $json[] .= $row['stationarabic'];
		 
	}
	echo json_encode($json);	
?>
