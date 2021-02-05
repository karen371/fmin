<?php
class solicitud_model{
    private $db;
    private $cliente;
    private $codigo;

    public function __construct(){
        $this->db=Conectar::conexion();
        $this->cliente=array();
    }
    public function get_solicitud(){
        $consulta=$this->db->query('SELECT codigo, UCASE(nombre) AS nombre FROM tiposolicitud  ORDER BY nombre ASC');
        while($filas=$consulta->fetch_assoc()){
            $this->cliente[]=$filas;
        }
        return $this->cliente;
    }

    public function  get_codigo($nombre){

      $consulta = $this->db->query('SELECT * FROM tiposolicitud WHERE nombre = "'.$nombre.'" ');
      if($cod = $consulta->fetch_assoc()){
          $this->cod =  $cod['codigo'];
      }
      return $this->cod;
    }
    public function Insert($nombre){
      if($this->db->query('INSERT INTO tiposolicitud( nombre) VALUES ("'.$nombre.'")')){
          return true;
      }
      else{
          return false;
      }
    }
}

?>
