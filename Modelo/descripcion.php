<?php
class descripcion_model{
    private $db;
    private $tabla;
    private $img;
    private $cargo;

    public function __construct(){
        $this->db = Conectar::conexion();
        $this->tabla = array();
        $this->img=array();
    }
    /*LLAMA A UNA VISTA Y MUESTRA LOS DATOS CUANDO TIENEN GUIA DE SALIDA*/
    public function get_descripcion(){
        $consulta=$this->db->query('SELECT * FROM descripcion;');
        while($filas=$consulta->fetch_assoc()){
            $this->tabla[]=$filas;
        }
        return $this->tabla;
    }
    /*LLAMA A UNA VISTA Y MUESTRA LOS DATOS CUANDO NO TIENEN GUIA DE SALIDA*/
    public function get_descripcionTodo(){
        $consulta=$this->db->query('SELECT * FROM descripcionTodo;');
        while($filas=$consulta->fetch_assoc()){
            $this->tabla[]=$filas;
        }
        return $this->tabla;
    }
    /*BUSCA EL MAXIMO IDENTIFICADOR DE LA TABLA descripcionot*/
    public function get_codMaximo(){
        $consulta=$this->db->query('SELECT MAX(codFolio) FROM descripcionot');
        if($max=$consulta->fetch_assoc()){
            return $max['MAX(codFolio)'];
        }
        else{
          return 0;
        }
    }
    /*CREA UN NUEVO CAMPO EN LA TABLA descripcionot*/
    public function Insert($codguia , $Estado, $TIPOSOLI){
       if($this->db->query('INSERT INTO descripcionot (Estado,ngC,TipoSolicitud ) VALUES ("'.$Estado.'", "'.$codguia.'","'.$TIPOSOLI.'")')){
          return true;
        }
        else{
          return false;
        }
    }
    /*ENTREGA EL NUMERO DE LA GUIA DE SALIDA DE UN FOLIO EN ESPECIFICO*/
    public function get_numGuiaS($folio){
        $consulta=$this->db->query('SELECT * FROM descripcionot WHERE codFolio = "'.$folio.'" ');
        if($guia=$consulta->fetch_assoc()){
            return $guia['ngE'];
        }
        else{
          return 0;
        }
    }
    /*ENTREGA EL NUMERO DE LA GUIA DE ENTRADA DE UN FOLIO EN ESPECIFICO*/
    public function get_numGuiaE($folio){
        $consulta=$this->db->query('SELECT * FROM descripcionot WHERE codFolio = "'.$folio.'" ');
        if($guia=$consulta->fetch_assoc()){
            return $guia['ngC'];
        }
        else{
          return 0;
        }
    }
    /*MODIFICA LOS DATOS DE UN FOLIO EN ESPECIFICO*/
    public function Modificar($folio , $nge){
        if($this->db->query('UPDATE descripcionot SET ngE="'.$nge.'" WHERE `codFolio` = "'.$folio.'"')){
          return true;
        }
        else{
          return false;
        }
    }
    /*VE SI EXISTE LA GUIA */
    public function Existe($folio){
        $consulta=$this->db->query('SELECT * FROM descripcionot AS d, gdespachoe AS g WHERE d.codFolio = "'.$folio.'" and d.ngE = g.codDe ');
        if($guia=$consulta->fetch_assoc()){
            return true;
        }
        else{
          return false;
        }
    }
    /*MODIFICAR ESTADO*/
    public function modificarDes($folio , $Estado, $TIPOSOLI){
        if($this->db->query('UPDATE descripcionot SET Estado="'.$Estado.'", TipoSolicitud= "'.$TIPOSOLI.'" WHERE codFolio = "'.$folio.'"')){
          return true;
        }else{
          return false;
        }
    }
    /*AGREGAR IMAGENES*/
    public function InsertImages($folio, $img, $des){
      if($this->db->query('INSERT INTO imgot(codfolio, imagen, descripcion) VALUES ("'.$folio.'","'.$img.'","'.$des.'" );')){
        return true;
      }
      else {
        return false;
      }
    }
    /*ELIMINAR IMAGENES*/
    public function EliminarImagen($id){
      if($this->db->query('DELETE FROM imgot WHERE codimg="'.$id.'" ')){
        return true;
      }else{
        return false;
      }
    }
    /*LISTA DE IMAGENES*/
    public function MostrarImagen($folio){
      $consulta=$this->db->query('SELECT * FROM imgot WHERE codfolio = "'.$folio.'"');
      while($filas=$consulta->fetch_assoc()){
          $this->img[]=$filas;
      }
      return $this->img;
    }

    public function get_Cargo(){
      $consulta = $this->db->query('SELECT cod, UCASE(nombre) AS nombre FROM cargo');
      while($fila = $consulta->fetch_assoc()){
        $this->cargo[]=$fila;
      }
      return $this->cargo;
    }
}
?>
