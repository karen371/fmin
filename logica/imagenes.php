<?php
require_once("../Datos/Connection.php");
require_once('../Modelo/descripcion.php');

$des      = new descripcion_model();
$image = new Imagenes();

class Imagenes
{
  private $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');

  function __construct()
  {
    // code...
  }


  function eliminar($img){
    unlink($img);
  }

  function validar($ext){
    if(in_array($ext, $this->valid_extensions)){
      return true;
    }
    else {
      return false;
    }
  }

}

switch ($_POST['clave']) {
  case 'AgregarI': /*INGRESAR IMAGENES*/
    try {
      $folio = $_POST['folio'];
      $descripcion = $_POST['descripcion'];
      $img  = $_FILES['img']['name'];
      $tmp  = $_FILES['img']['tmp_name'];
      $path = '../imagenes/';
      $ext  = strtolower(pathinfo($img, PATHINFO_EXTENSION));
      if($image->validar($ext)){
        $img_final = $folio.''.$img;
        $path = $path.strtolower($img_final);
        if(move_uploaded_file($tmp, $path)){

          if($des->InsertImages($folio , $path, $descripcion)){
            echo "Ingresado con exito";
            /*Devolver la lista de elementos*/
            break;
          }
          else{  echo 'error'; break;}
       }
       else{ echo 'error'; break; }
     }
     else{
       echo 'error'; break;
     }
    } catch (Exception $e) {
      break;
    }
  case 'EliminarI':/*ELIMINAR IMAGENES*/
      //echo 'hola';
      $id = $_POST['img'];
      $direccion = $_POST['direccion'];
      if($des->EliminarImagen($id)){
        $image->eliminar($direccion);
        echo 'Eliminado con exito';
        break;
      }
      else{
        echo 'error';
        break;
      }
  default:
    echo 'error';
    break;
}

?>
