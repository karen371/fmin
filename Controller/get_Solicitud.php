<?php

	require_once('../Datos/Connection.php');

	 $db;

	$db = Conectar::conexion();
	  $consulta=$db->query('SELECT codigo, UCASE(nombre) AS nombre FROM tiposolicitud  ORDER BY nombre ASC;');
		$html = "<option>Seleccione una Opcion</option>";

		  while($filas=$consulta->fetch_assoc())
		{
			$html.= "<option value='".$filas['codigo']."'>".$filas['nombre']."</option>";
		}
		echo $html;
?>
