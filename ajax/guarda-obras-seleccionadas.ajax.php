<?php

 session_start();          // Start the session
$_SESSION['idObrasSeleccionadas']=array(); // Makes the session an array

$i = 0;

foreach($_POST['idObrabox'] as $selected){
   array_push($_SESSION['idObrasSeleccionadas'],$selected); 
  
  }

  echo 1;
 
 
?>