<?php
require_once('../Datos/Connection.php');
require_once('../Modelo/Trabajador.php');
session_start();

$conexion = new Trabajador();

if(isset($_POST['user']) && isset($_POST['pass'])){
  //variables
  $USUARIO = $_POST['user'];
  $PASS = $_POST['pass'];

  if($conexion->Usuario_Valido($USUARIO, $PASS)){
    $usu = $conexion->get_Usuario($USUARIO, $PASS);
    foreach ($usu as $u) {
      $_SESSION['nombre']   = $u['nombre'];
      $_SESSION['apellido'] = $u['apellido'];
      $jsondata['codigo']   = 1;
    }
  }
  else{
    $jsondata['codigo']  = 2;
    $jsondata['mensaje'] = "Usuario no registrado";
  }
}
else {
  $jsondata['codigo'] = 2;
  $jsondata['mensaje'] = "Error de Conexion";
 }
header("Content-Type: application/json", true);
echo json_encode($jsondata);
?>
