<?php
//Llamada al modelo


  require_once("../Modelo/descripcion.php");
  $tabla=new  descripcion_model();
  $datos=$tabla->get_descripcion();
  $todo = $tabla->get_descripcionTodo();
  //Llamada a la vista

?>
