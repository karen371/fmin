<?php
require_once('../Datos/Connection.php');
require_once('../Modelo/Solicitud.php');

$solicitud = new solicitud_model();

if($_POST['nomsolid'] != ''){
  if($solicitud->Insert($_POST['nomsolid'])){
    /*FALTA REFRESCAR EL SELECT*/
      echo 'ok';
  }
  else {echo 'error'; }
}
else {echo 'error';}

 ?>
