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


if($_POST['cargo'] == 'inicio' || $_POST['contrasena'] == '' || $_POST['usuario'] == ''){
    echo 'error';
}else{

  $rut = $_POST['rut']; $nombre = $_POST['nombre']; $apellido = $_POST['apellido'];
   $usuario =  $_POST['usuario'];$contrasena = $_POST['contrasena']; $cargo = $_POST['cargo'];
    if($trabajador->insert_Usuario($rut,$nombre,$apellido,$contrasena,$usuario,$cargo)){
        echo 'Se ha registrado con exito';
    }
    else{
        echo 'error';
    }

}



 ?>
