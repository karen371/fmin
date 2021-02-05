<?php
session_start();
require_once('../Datos/Connection.php');
require_once('../Modelo/Trabajador.php');
require_once('../Modelo/cliente.php');
require_once('../Modelo/Solicitud.php');
require_once('../Modelo/GuiaEntrada.php');
require_once('../Modelo/descripcion.php');
require_once('../Modelo/GuiaSalida.php');
require_once('../Modelo/Estado.php');
require_once('Documento.php');

$trabajador  = new Trabajador();
$CLI         = new cliente_model();
$SOL         = new solicitud_model();
$guia        = new GuiaEntrada();
$des         = new descripcion_model();
$guiaS       = new GuiaSalida();
$state       = new Estado();
$file        = new Documento();

$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt','txt'); // valid extensions
$path = '../Archivos/';


if(!empty($_POST['numero']) || !empty($_POST['codigo']) || !empty($_FILES['doc']) || !empty($_POST['detalle']) ||
 !empty($_POST['fecha']) || !empty($_POST['cliente']) || !empty($_POST['solicitud']) || !empty($_FILES['docIng']) ){

       $NUMERO   = $_POST['numero'];    $CODIGO   = $_POST['codigo'];     $FECHA    = $_POST['fecha'];
       $DETALLE  = $_POST['detalle'];   $CLIENTE  = $_POST['cliente'];    $TIPOSOLI = $_POST['solicitud'];
       $folio    = $_POST['folio'];     $FECHASAL = $_POST['fechasal'];   $NUMSAL   = $_POST['numsal'];
       $Estado   = $_POST['estado'];
       $newDate  = date("d-m-Y", strtotime($FECHA));  $nfecha   = date("d-m-Y", strtotime($FECHASAL));

       //CODIGO DE CLIENTE
       $codCli = $CLI->get_codigo($CLIENTE);
       //CODIGO DE SOLICITUD
       $codSol = $SOL->get_codigo($TIPOSOLI);
       //CODIGO GUIA DE SALIDA
       $codNge = $des->get_numGuiaS($folio);
       //CODIGO GUIA DE ENTRADA
       $codNgc = $des->get_numGuiaE($folio);
       //CODIGO ESTADO
       $codEst = $state->get_codigo($Estado);

       /*VERIFICAR DOCUMENOTO DE GUIA DE INGRESO */
          /*Insertar datos  */
          if($guia->Modificar($NUMERO, $codCli, $codSol, $CODIGO, $DETALLE, $newDate, $codNgc) == true){ /*MODIFICAR ESTADO EN DESCRIPCION*/
            if($codNge>0){ /*FALTA MODIFICAR DOCUMENTACION*/

              $doc = $_FILES['doc']['name'];
              $tmp = $_FILES['doc']['tmp_name'];
              $docGuia = $guiaS->Documento($NUMSAL);
              /*devuelve la informacin del documento*/
              $ext = strtolower(pathinfo($doc, PATHINFO_EXTENSION));
                if($file->ValidarArchivo($ext, $valid_extensions)){
                    $doc_final = $_POST['numsal'].''.$doc;
                    $path = $path.strtolower($doc_final);
                    $file->EliminarArchivo($docGuia);
                      //buscar el codigo de la guia
                        if($file->SubirArchivo($tmp,$path)){
                          /*MODIFICAR ARCHIVOS*/
                          if($guiaS->UpdatedDocumento($nfecha,$NUMSAL,$des->get_numGuiaS($folio),$path)){
                            if($des->modificarDes($folio , $codEst)){
                                echo  'Se han Modificado los datos con exito' .$docGuia;
                            }
                            else {echo 'invalid';}
                          }
                        }
                        else{echo 'invalid';}
                }/*ARCHIVO QUE PROVIENE DE LA BD*/
                else{
                  if($guiaS->Update($nfecha,$NUMSAL,$codNge)){
                      if($des->modificarDes($folio , $codEst)){
                        echo  'Se han Modificado los datos con exito ';
                      }
                      else{echo 'invalid';}
                    }
                    else{echo 'invalid';}
                }
           }
         }
        else{/*ESTE INGRESA UNA NUEVA GUIA SE DESPACHO (SALIDA)*/
             /*nombre de el documento y nombre temporal*/
             $doc = $_FILES['doc']['name'];
             $tmp = $_FILES['doc']['tmp_name'];
             /*devuelve la informacin del documento*/
             $ext = strtolower(pathinfo($doc, PATHINFO_EXTENSION));
             $doc_final = $_POST['numsal'].''.$doc;

             /*asignacion del nombre que se guardara el documento el cual sera numero de guia + nombre de el documento*/
             if($file->ValidarArchivo($ext, $valid_extensions)){
               /*devuelve los caracteres en minuscula*/
               $path = $path.strtolower($doc_final);
               if($file->SubirArchivo($tmp,$path)){
                 if($guiaS->InsertGuia($nfecha,$NUMSAL,$path )){
                     $num = $guiaS->get_codMaximo ();
                     $des-> Modificar($folio, $num );
                     echo 'Se han Modificado los datos con exito';
                 }
                 else{echo 'error';}
                }
               }
               else{echo 'invalid';}
             }
         }
         else{echo 'error';}
/*
  -realizar la verficacion de el documento de entrada
  -realizar la eliminacion de el documento que ya se encuentra guardado
  -subir el nuevo documento
  -modificar o actualizar el documento junto con los demas datos
  -
*/



 ?>
