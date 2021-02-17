<?php

	require_once('../Datos/Connection.php');

	 $db;

	$db = Conectar::conexion();
	  $consulta=$db->query('SELECT codcliente, UCASE(nomcliente) AS nomcliente from cliente ORDER BY nomcliente ASC;');
		$html = "<option value='inicio'>Seleccione una Opcion</option>";
		  while($filas=$consulta->fetch_assoc())
		{
			$html.= "<option value='".$filas['codcliente']."'>".$filas['nomcliente']."</option>";
		}
		echo $html;
?>
