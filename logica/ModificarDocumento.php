<?php

/**
 *
 */
 require_once('../Datos/Connection.php');
 require_once('../Modelo/GuiaEntrada.php');
 require_once('../Modelo/GuiaSalida.php');
 require_once('../Modelo/Estado.php');
 require_once('../Modelo/descripcion.php');
 require_once('Documento.php');
 $des         = new descripcion_model();
 $guia        = new GuiaEntrada();
 $guiaS       = new GuiaSalida();
 $file        = new Documento();


//echo  $_POST['folio'];
switch ($_POST['clave']) {
  case 'EliminarE':
  try {
    $codNgc = $des->get_numGuiaE($_POST['folio']);
    $doc = $guia->Documento($codNgc);
    if($doc == NULL || $doc == ""){
        echo "No hay archivo";
        break;
    }
    else{
      $file->EliminarArchivo($doc);
      $guia->eliminarDoc($codNgc);
      echo "Eliminado con exito";
      break;
    }
  } catch (Exception $e) {
    echo 'error';
    break;
  }
  case 'EliminarS':
  try {
    $codNge = $des->get_numGuiaS($_POST['folio']);
    $doc = $guiaS->Documento($codNge);
    if($doc == NULL || $doc == ""){
        echo "No hay archivo";
        break;
    }
    else{
      $file->EliminarArchivo($doc);
      $guiaS->eliminarDoc($codNge);
      echo "Eliminado con exito ";
      break;
    }
  } catch (Exception $e) {
    echo 'error';
    break;
  }
  case 'AgregarE':
  try {
    $codNgc = $des->get_numGuiaE($_POST['folio']);
    $doc = $_FILES['docE']['name'];
    $tmp = $_FILES['docE']['tmp_name'];
    //echo $doc;
    $path = '../Archivos/';
    $ext = strtolower(pathinfo($doc, PATHINFO_EXTENSION));
    if($file->ValidarArchivo($ext)){
      $doc_final = $_POST['numero'].''.$doc;
      $path = $path.strtolower($doc_final);
        if(move_uploaded_file($tmp, $path)){
          $docE = $guia->Documento($codNgc);
          if($docE == NULL || $docE == "" || $docE == " "){
            $guia->UpdatedDocumento($codNgc, $path);
             echo "Se ha agregado correctamente";
             break;
          }
          else{
            $file->EliminarArchivo($docE);
            $guia->UpdatedDocumento($codNgc, $path);
            echo "Se ha agregado correctamente";
            break;
          }
        }
        else{
          echo "error";
          break;
        }
    }
    else{
      echo "error";
        break;
    }
  } catch (Exception $e) {
    echo 'error';
    break;
  }
  case 'AgregarS':
  try{ //cambiar clases
    $codNge = $des->get_numGuiaS($_POST['folio']);
    $doc = $_FILES['doc']['name'];
    $tmp = $_FILES['doc']['tmp_name'];
    //echo $doc;
    $path = '../Archivos/';
    $ext = strtolower(pathinfo($doc, PATHINFO_EXTENSION));
    if($file->ValidarArchivo($ext)){
      $doc_final = $_POST['numsal'].''.$doc;
      $path = $path.strtolower($doc_final);
        if(move_uploaded_file($tmp, $path)){
          $docE = $guiaS->Documento($codNge); //preguntar si el campo esta vacio para no aparesca el error
          if($docE == NULL || $docE == ""){
            $guiaS->UpdatedDocumento2($codNge, $path);
            echo "Se ha agregado correctamente";
            break;
          }
          else{
            $file->EliminarArchivo($docE);
            $guiaS->UpdatedDocumento2($codNge, $path);
            echo "Se ha agregado correctamente";
            break;
          }
        }
        else{
          echo "error";
            break;
        }
    }
    else{
      echo "error";
      break;
    }
  } catch (Exception $e) {
    echo 'error';
    break;
  }
  default:
    echo "error";
    break;
}

 ?>
