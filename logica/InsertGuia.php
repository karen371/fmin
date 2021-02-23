<?php
session_start();


//$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt','txt');
//$path = '../Archivos/';

if($_POST['numero'] == '' || $_POST['fecha'] == ''){
  $jsondata['mensaje'] = "vacio";
}
else{
    $NUMSAL = $_POST['numero'];
    $nfecha = $_POST['fecha'];
    $folio  = $_POST['codigo'];

    $jsondata['mensaje'] = $NUMSAL." ".$nfecha." ".$folio;
}

header("Content-Type: application/json", true);
 echo json_encode($jsondata);
?>
