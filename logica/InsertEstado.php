<?php
require_once('../Datos/Connection.php');
require_once('../Modelo/Estado.php');

$estado = new Estado();

if($_POST['nomEst'] != ''){
  if($estado->Insert($_POST['nomEst'])){
    /*FALTA REFRESCAR EL SELECT*/
      echo 'ok';
  }
  else {echo 'error'; }
}
else {echo 'error';}

 ?>
