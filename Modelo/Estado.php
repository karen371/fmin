<?php
class Estado{
  /*VARIABLES*/
    private $db;
    private $Estado;
    private $cod;

    public function __construct(){
        $this->db=Conectar::conexion();
        $this->Estado=array();
    }
    /*MOSTRAR UN LISTADO CON NOMBRES DE LOS CLIENTES*/
    public function get_estado(){
        $consulta=$this->db->query('SELECT codigo, UCASE(nombre) AS nombre from estado ORDER BY nombre ASC;');
        while($filas=$consulta->fetch_assoc()){
            $this->Estado[]=$filas;
        }
        return $this->Estado;
    }
    /*DEVOLVER EL CODIGO DE UN CLIENTE EN ESPECIFICO*/
    public function  get_codigo($estado){
      $consulta = $this->db->query('SELECT * FROM estado WHERE nombre= "'.$estado.'"');
      if($codi = $consulta->fetch_assoc()){
          $this->cod =  $codi['codigo'];
      }
      return $this->cod;
    }
}
 ?>
