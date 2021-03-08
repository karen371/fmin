<?php
session_start();
require_once('../Datos/Connection.php');
require_once('../Modelo/Trabajador.php');

 $trabajador =  new Trabajador();

try {
  if(isset($_POST['user']) && isset($_POST['pass'])){
    $USUARIO = $_POST['user'];
    $PASS = $_POST['pass'];
     if($trabajador->Usuario_Valido($USUARIO, $PASS)){
       $usu = $trabajador->get_Usuario($USUARIO, $PASS);
       foreach ($usu as $u) {
            $_SESSION['nombre']   = $u['nombre'];
            $_SESSION['apellido'] = $u['apellido'];
            $jsondata['codigo']   = 1;
        }
     }
     else{
       $jsondata['codigo']  = 2;
       $jsondata['mensaje'] = "Usuario y/o contraseña incorrecto";
     }
  }
  else{
    $jsondata['codigo'] = 2;
    $jsondata['mensaje'] = "Error de Conexion";
  }
} catch (Exception $e) {
  $jsondata['codigo'] = 2;
  $jsondata['mensaje'] = "Error de Conexion";
}




header("Content-Type: application/json", true);
echo json_encode($jsondata);
 ?>
