<?php
/** *  */
class GuiaEntrada
{
  private $db;
  private $guia;

  function __construct(){
    $this->db=Conectar::conexion();
    $this->guia=array();
  }
/*FALTA INGRESAR DOCUMENTO*/
  public function InsertGuia($NUMERO, $numcliente, $CODIGO, $DETALLE ,$newDate, $codTrabajador){
        if($this->db->query('INSERT INTO gdespachoc (codnumero, codcliente, codS, descripcion, fecha, encargado,archivo)
                  VALUES ("'.$NUMERO.'","'.$numcliente.'","'.$CODIGO.'","'.$DETALLE.'","'.$newDate.'","'.$codTrabajador.'","")')){
          return true;
        }
        else{
          return false;
        }
  }
/*FALTA CAMBIAR EL DOCUMENTO*/ /*revisar el codigo ingresado como codigo guia*/
  public function Modificar($NUMERO, $numcli,  $CODIGO, $DETALLE ,$newDate, $numeroguia){
      if($this->db->query('UPDATE gdespachoc SET codnumero= "'.$NUMERO.'" , codcliente= "'.$numcli.'" ,
                codS= "'.$CODIGO.'", descripcion= "'.$DETALLE.'", fecha= "'.$newDate.'" WHERE codDc= "'.$numeroguia.'"  ')){
        return true;
      }
      else{
        return false;
      }
  }

  /*FALTA CAMBIAR EL DOCUMENTO*/ /*revisar el codigo ingresado como codigo guia*/
    public function ModificarDocumento($NUMERO, $numcli, $numsol, $CODIGO, $DETALLE ,$newDate, $numeroguia, $doc){
        if($this->db->query('UPDATE gdespachoc SET codnumero= "'.$NUMERO.'", codcliente="'.$numcli.'" , TipoSolicitud= "'.$numsol.'",
                              codS="'.$CODIGO.'" ,descripcion="'.$DETALLE.'" ,fecha="'.$newDate.'"  ,archivo="'.$doc.'"
                              WHERE  codDc= "'.$numeroguia.'"  ')){
          return true;
        }
        else{
          return false;
        }
    }

  /*ENTREGA EL CODIGO DE EL ULTIMO REGISTRO*/
  public function get_codMaximo (){
      $consulta=$this->db->query('SELECT MAX(codDc) FROM gdespachoc');
      if($max=$consulta->fetch_assoc()){
          return $max['MAX(codDc)'];
      }
      else{
        return 0;
      }
  }

  /*direccion de el Archivo*/
  public function Documento($num){
      $consulta=$this->db->query('SELECT * FROM gdespachoc WHERE codDc ='.$num);
      if($con=$consulta->fetch_assoc()){
          return $con['archivo'];
      }
  }

  /*NOMBRE DE EL ARCHIVO*/
  public function NombreDocumento($num){
      $consulta = $this->db->query('SELECT * FROM gdespachoc WHERE codDc ='.$num);
      if($con = $consulta->fetch_assoc()){
        $path = $con['archivo'];
        $archivo = basename($path);
        return $archivo;
      }
  }
  public function eliminarDoc($num){
    //eliminar el documento de la base de datos
    if($this->db->query('UPDATE gdespachoc SET archivo = "" WHERE codDc ='.$num)){
        return true;
    }
    else { return false;}
  }

  public function UpdatedDocumento($num, $doc){
    //eliminar el documento de la base de datos
    if($this->db->query('UPDATE `gdespachoc` SET archivo = "'.$doc.'"  WHERE codDc ='.$num)){
        return true;
    }
    else { return false;}
  }

}
 ?>
