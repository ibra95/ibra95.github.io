<?php
$mysqli =  mysqli_connect('localhost', 'root','','public_cairo');
mysqli_set_charset($mysqli,"utf8");
$Query = $_GET['query'];
$sql = "SELECT DISTINCT * FROM area 
			WHERE name  LIKE '%".$_GET['query']."%'
	
			 ";
$result = mysqli_query($mysqli,$sql);
$json = [];
while($row = $result->fetch_assoc()){
    $json[] = $row['name'];
   // $json[] .= $row['stationarabic'];

}
echo json_encode($json);
?>
