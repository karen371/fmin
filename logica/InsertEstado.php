<?php
require_once('../Datos/Connection.php');
require_once('../Modelo/Estado.php');

$estado = new Estado();

if($_POST['nomEstado'] != ''){
  if($estado->Insert($_POST['nomEstado'])){
    /*FALTA REFRESCAR EL SELECT*/
      echo 'ok';
  }
  else {echo 'error'; }
}
else {echo 'error';}

 ?>
