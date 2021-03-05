<?php

require_once("../Modelo/descripcion.php");
$cargo = new   descripcion_model();
$datos=$cargo->get_Cargo();

//Llamada a la vista
 ?>
