<?php
//check password function
function CheckPassword($pwd) {
    $errors[]="";

    if (strlen($pwd) < 8) {
        $errors[] = "Password too short!";
    }

    if (!preg_match("#[0-9]+#", $pwd)) {
        $errors[] = "Password must include at least one number!";
    }

    if (!preg_match("#[a-zA-Z]+#", $pwd)) {
        $errors[] = "Password must include at least one letter!";
    }     
   
    return  $errors;
	
   }
   
//redirect function
function Redirect($Location){
  header("location:".$Location);
  exit;
}


//session message
session_start();
function Message(){
   if (isset($_SESSION["Success"])){
    $Output="<div class=\" alert alert-Success\" >";
    $Output.=htmlentities($_SESSION['Success']);
    $Output.="</div>";
    $_SESSION['Success']=null;
    return $Output;
   }
   }
   
?>