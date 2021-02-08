<?php
require_once('../Datos/Connection.php');
require_once('../Modelo/cliente.php');


$cliente   = new  cliente_model();

if($_POST['nomCliente'] != ''){
  if($cliente->Insert($_POST['nomCliente'])){
    /*FALTA REFRESCAR EL SELECT*/
      echo 'ok';
  }
  else {echo 'error'; }
}
else {echo 'error';}

 ?>
