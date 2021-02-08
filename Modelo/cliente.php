<?php
class cliente_model{
  /*VARIABLES*/
    private $db;
    private $cliente;
    private $cod;

    public function __construct(){
        $this->db = Conectar::conexion();
        $this->cliente=array();
    }
    /*MOSTRAR UN LISTADO CON NOMBRES DE LOS CLIENTES*/
    public function get_cliente(){
        $consulta=$this->db->query('SELECT codcliente, UCASE(nomcliente) AS nomcliente from cliente ORDER BY nomcliente ASC;');
        while($filas=$consulta->fetch_assoc()){
            $this->cliente[]=$filas;
        }
        return $this->cliente;
    }
    /*DEVOLVER EL CODIGO DE UN CLIENTE EN ESPECIFICO*/
    public function  get_codigo($CLIENTE){
      $consulta = $this->db->query('SELECT * FROM cliente WHERE nomcliente= "'.$CLIENTE.'"');
      if($codi = $consulta->fetch_assoc()){
          $this->cod =  $codi['codcliente'];
      }
      return $this->cod;
    }
    public function Insert($nombre){
      if($this->db->query('INSERT INTO  cliente (nomcliente) VALUES ("'.$nombre.'")')){
          return true;
      }
      else{
          return false;
      }
    }
}

?>
