<?php

require_once("../Modelo/cliente.php");
$cliente=new  cliente_model();
$datos=$cliente->get_cliente();

//Llamada a la vista


 ?>
