<?php


	require_once('../Datos/Connection.php');

	$db;
	$numero = $_POST['codigo'];
	$db = Conectar::conexion();
  $consulta = $db->query('SELECT e.codnumero, e.fecha FROM `descripcionot`as t, gdespachoe as e WHERE t.codFolio = "'.$numero.'" and t.ngE =e.codDe');
  $html= " ";
  if($con = $consulta->fetch_assoc()){
      $html = $con['codnumero'].'/'.$con['fecha'];
  }
	echo $html;
?>
