<?php
session_start();
require_once('../Datos/Connection.php');
require_once('../Modelo/GuiaSalida.php');
require_once('../Modelo/descripcion.php');
require_once('Documento.php');

$file        = new Documento();
$guiaS       = new GuiaSalida();
$des         = new descripcion_model();
//$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt','txt');
$path = '../Archivos/';

//echo $_POST['numero'].' '.$_POST['fecha2'].' '.$_POST['folio'];

if($_POST['numero'] == ' ' || $_POST['fecha2'] == ' '){
   echo "vacio";
}
else{
  $numS  = $_POST['numero'];
  $fecha = $_POST['fecha2'];
  $folio = $_POST['folio'];
  $newDate  = date("d-m-Y", strtotime($fecha));
  if($guiaS->InsertGuia($newDate,$numS,'')){
      /*sacar el codigo de la guia para ingresarle a la tabla descripcion*/
      $num = $guiaS->get_codMaximo ();
      $des-> Modificar($folio, $num );
      echo 'Datos ingresados con exito';
  }
  else{ echo 'error'; }
}


/*
if($_POST['numero'] == '' || $_POST['fecha'] == ''){
  $jsondata['mensaje'] = "vacio";
}
else{
    $numS  = $_POST['numero'];
    $fecha = $_POST['fecha'];
    $folio = $_POST['folio'];
    $newDate  = date("d-m-Y", strtotime($fecha));

     $doc = $_FILES['doc']['name'];
     $tmp = $_FILES['doc']['tmp_name'];
    $ext = strtolower(pathinfo($doc, PATHINFO_EXTENSION));
    if($file->ValidarArchivo($ext)){
      $doc_final= $numS.''.$doc;
      $path = $path.strtolower($doc_final);
      if(move_uploaded_file($tmp,$path)){
        if($guiaS->InsertGuia($newDate,$numS,$path)){*/
          /*sacar el codigo de la guia para ingresarle a la tabla descripcion*/
    /*        $num = $guiaS->get_codMaximo ();
            $des-> Modificar($folio, $num );
            $jsondata['mensaje']= 'Datos ingresados con exito';
          }
        else{$jsondata['mensaje'] = 'error';}
      }
      else{
        $jsondata['mensaje'] = 'error';
      }
    }
    else{
      $jsondata['mensaje'] = 'falla';
    }*/
    /*if($file->ValidarArchivos($ext)){
      $doc_final = $numS.''.$doc;
      $path = $path.strtolower($doc_final);
      if(move_uploaded_file($tmp, $path)){
        if($guiaS->InsertGuia($newDate, $numS , $path)){
          $jsondata['mensaje']= "Se ha agregado correctamente";
        }
        else {$jsondata['mensaje'] = 'error'; }
      }
      else{$jsondata['mensaje'] = 'error';}
    }*/
  //  else{$jsondata['mensaje'] = 'error';}

  //
//}
/*header("Content-Type: application/json", true);
 echo json_encode($jsondata);*/
?>
