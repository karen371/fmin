<?php
require_once('../Datos/Connection.php');
require_once('../Modelo/Solicitud.php');

$solicitud = new solicitud_model();

if($_POST['nomSolicitud'] != ''){

  if($solicitud->Insert($_POST['nomSolicitud'])){
    echo 'ok';
  }
  else {echo 'error'; }
}
else {echo 'error';}

 ?>
