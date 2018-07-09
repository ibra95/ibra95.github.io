<?php
require('functions.php');
$CurrentLocationError='';
$Server='localhost';
$UserName='root';
$Password='';
$DatabaseName='';
if(isset($_POST['search'])){//assign differernt database name according to select option
if ($_POST['options']=='1'){
$DatabaseName='traindb';
}elseif($_POST['options']=='2') {
  $DatabaseName='public_cairo';
}elseif($_POST['options']=='3') {
  $DatabaseName='superjetdb';
}

}

 if(isset($_POST['search'])){
   $Connection=mysqli_connect($Server,$UserName,'',$DatabaseName);
   mysqli_set_charset($Connection,"utf8");//arabic charset
   	$CurrentLocation='';
    $RequiredLocation='';
    $SelectedOption='';
   if (!empty($_POST['currentloc']) && !empty($_POST['requiredloc']) && !($_POST['options'])=='0'){
	  $CurrentLocation=mysqli_real_escape_string($Connection,$_POST['currentloc']);
      $RequiredLocation=mysqli_real_escape_string($Connection,$_POST['requiredloc']);
      $SelectedOption = $_POST['options'];

	} else{
        $CurrentLocationError="<br>"."<div class='alert-empty'>".'<span class="glyphicon glyphicon-warning-sign"></span>';
        $CurrentLocationError.=" Please Fill ALL Empty Fields ".'</div>';

        }
 }


?>
