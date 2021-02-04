<?php


require_once('../Modelo/GuiaEntrada.php');

if(isset($_POST['numero']) && isset($_POST['codigo']) && isset($_POST['fecha'])
    && $_POST['detalle'] && $_POST['cliente'] && $_POST['solicitud'] ){
      $jsondata['mensaje'] = 'Hola';
          $jsondata['codigo'] = 1;
}
else{
  $jsondata['mensaje'] = 'Error ';
  $jsondata['codigo'] = 2;
}

header("Content-Type: application/json", true);
echo json_encode($jsondata);
 ?>
