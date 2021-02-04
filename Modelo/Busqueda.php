<?php

class Busqueda{
    private $db;
    private $Tabla;

    public function __construct(){
        $this->db = Conectar::conexion();
        $this->Tabla = array();
    }
    /*BUSQUEDA POR NUMERO DE GUIAS */
    public function get_BusquedaGuia($num){
        $consulta = $this->db->query('CALL busquedaGuia("'.$num.'");');
        if($filas = $consulta->fetch_assoc()){
            $this->Tabla[]=$filas;
        }
        return $this->Tabla;
    }
    /*BUSQUEDA POR EL NUMERO DE FOLIO */
    public function get_BusquedaFolio($num){
        $consulta = $this->db->query('CALL busqueda("'.$num.'");');
        if($filas = $consulta->fetch_assoc()){
            $this->Tabla[]=$filas;
        }
        return $this->Tabla;
    }
    /*MUESTRA DE EL NUMERO DE GUIA Y FECHA (EGRESO) POR FOLIO*/
    public function BuscarDetalle($num){
      $consulta = $this->db->query('CALL descripcion ("'.$num.'");');
      if($fila = $consulta->fetch_assoc()){
          $this->Tabla[] = $fila;
      }
      return $this->Tabla;
    }
    /*BUSCAR SI EXISTE */
    public function ExisteFolio($num){
      $consulta = $this->db->query('SELECT * FROM descripcionOT WHERE codFolio = "'.$num.'"');
      if($filas = $consulta->fetch_assoc()){
          return true;
      }
      return false;
    }
    /*VER LA GUIA QUES SE ESTA BUSCANDO */
    public function ExisteGuia ($num){
      $consulta = $this->db->query('SELECT * FROM GdespachoC WHERE codnumero = "'.$num.'"');
      if($filas = $consulta->fetch_assoc()){
          return true;
      }
      return false;
    }
}
?>
