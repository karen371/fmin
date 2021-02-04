<?php
require_once("../Modelo/Busqueda.php");
$buscar=new  Busqueda();
$bfolio= $buscar->get_Busqueda($_GET['Search']);
$bguia = $buscar->get_descripcionTodo($_GET['Search']);

Location('Busqueda.php');

 ?>
