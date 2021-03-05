<?php


	require_once('../Datos/Connection.php');

	$db;
	$numero = $_POST['codigo'];
	$db = Conectar::conexion();
  $consulta = $db->query('SELECT * FROM gdespachoe WHERE codnumero = "'.$numero.'" ');
  $html = '';
  if($con = $consulta->fetch_assoc()){
    $path = $con['archivo'];
    $archivo = basename($path);
    $html = $archivo;
  }
	echo $html;
?>
