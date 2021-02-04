<?php

class Trabajador
{
  private $db;
  private $cod;
  private $usuario;

  function __construct()
  {
    $this->db=Conectar::conexion();
  }

  public function get_codigo($nombre , $apellido){
    $consulta = $this->db->query('SELECT * FROM trabajador WHERE nombre = "'.$nombre.'" AND apellido = "'.$apellido.'"');
    if($cod = $consulta->fetch_assoc()){
        $this->cod =  $cod['codtrab'];
    }
    return $this->cod;
  }

  public function Usuario_Valido($usuario, $contraseña){
    $consulta = $this->db->query('SELECT * FROM trabajador WHERE rutTrab = "'.$usuario.'" and contrasena= "'.$contraseña.'" and ConEstab = 1');
    if($usu = $consulta->fetch_assoc()){
       return true;
    }
    else{
      return false;
    }
  }

  public function get_Usuario($usuario, $contraseña){
    $consulta = $this->db->query('SELECT * FROM trabajador WHERE rutTrab = "'.$usuario.'" and contrasena= "'.$contraseña.'" and ConEstab = 1');
    while($usu = $consulta->fetch_assoc()){
       $this->usuario[]=$usu;
    }
    return $this->usuario;
  }

}

 ?>
