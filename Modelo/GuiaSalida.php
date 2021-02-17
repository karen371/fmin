<?php

class GuiaSalida
{
  private $db;
  private $guia;

  function __construct()
  {
    $this->db=Conectar::conexion();
    $this->guia=array();
  }
  /*FALTA INGRESAR DOCUMENTACION */
  public function InsertGuia($fecha, $num, $doc ){
      if($this->db->query('INSERT INTO gdespachoe( codnumero, fecha, archivo) VALUES ("'.$num.'", "'.$fecha.'", "'.$doc.'")')){
        return true;
      }
      else{
        return false;
      }
  }
  /*FALTA CAMBIAR EL DOCUMENTO*/
  public function Update($fecha, $num, $cod){
      if($this->db->query('UPDATE gdespachoe SET codnumero= "'.$num.'" ,fecha ="'.$fecha.'" WHERE codDe ="'.$cod.'"')){
        return true;
      }
      else{
        return false;
      }
  }
  /*ENTREGA EL CODIGO DE EL ULTMIMO REGISTRO */
  public function get_codMaximo (){
      $consulta=$this->db->query('SELECT MAX(codDe) FROM gdespachoe');
      if($max = $consulta->fetch_assoc()){
          return $max['MAX(codDe)'];
      }
      else{
        return 0;
      }
  }

  /*direccion de el Archivo*/
  public function Documento($num){
      $consulta=$this->db->query('SELECT * FROM gdespachoe WHERE codnumero ='.$num);
      if($con=$consulta->fetch_assoc()){
          return $con['archivo'];
      }
  }

  /*NOMBRE DE EL ARCHIVO*/
  public function NombreDocumento($num){
      $consulta = $this->db->query('SELECT * FROM gdespachoe WHERE codnumero ='.$num);
      if($con = $consulta->fetch_assoc()){
        $path = $con['archivo'];
        $archivo = basename($path);
        return $archivo;
      }
  }
  /*FALTA CAMBIAR EL DOCUMENTO*/
  public function UpdatedDocumento($fecha, $num, $cod, $doc){
      if($this->db->query('UPDATE gdespachoe SET codnumero="'.$num.'", fecha="'.$fecha.'", archivo="'.$doc.'" WHERE codDe ="'.$cod.'"')){
        return true;
      }
      else{
        return false;
      }
  }
}

 ?>
