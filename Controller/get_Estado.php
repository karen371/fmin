<?php

	require_once('../Datos/Connection.php');

	 $db;

	$db = Conectar::conexion();
	  $consulta=$db->query('SELECT codigo, UCASE(nombre) AS nombre from estado ORDER BY nombre ASC;');
		$html = "<option value='inicio'>Seleccione una Opcion</option>";

		  while($filas=$consulta->fetch_assoc())
		{
			$html.= "<option value='".$filas['codigo']."'>".$filas['nombre']."</option>";
		}
		echo $html;
?>
