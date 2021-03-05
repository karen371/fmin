<?php

/*
formData.append("rut", $("#numero").val());
formData.append("nombre", $("#codigo").val());
formData.append("apellido", $("#fecha").val());
formData.append("usuario", $("#cliente").val());
formData.append("contrasena", $("#solicitud").val());
formData.append("cargo", $("#cargo").val());

*/

require_once('../Datos/Connection.php');
require_once('../Modelo/Trabajador.php');
session_start();

$trabajador= new Trabajador();

echo 'hola';


 ?>
