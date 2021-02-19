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


if(!empty($_POST['numero']) || !empty($_POST['codigo']) || !empty($_FILES['doc']) || !empty($_POST['detalle']) ||
 !empty($_POST['fecha']) || !empty($_POST['cliente']) || !empty($_POST['solicitud']) ){

       $NUMERO   = $_POST['numero'];    $CODIGO   = $_POST['codigo'];     $FECHA    = $_POST['fecha'];
       $DETALLE  = $_POST['detalle'];   $CLIENTE  = $_POST['cliente'];    $TIPOSOLI = $_POST['solicitud'];
       $folio    = $_POST['folio'];     $FECHASAL = $_POST['fechasal'];   $NUMSAL   = $_POST['numsal'];
       $Estado   = $_POST['estado'];
       $newDate  = date("d-m-Y", strtotime($FECHA));  $nfecha   = date("d-m-Y", strtotime($FECHASAL));
       //CODIGO GUIA DE SALIDA
$codNge = $des->get_numGuiaS($folio);
//CODIGO GUIA DE ENTRADA
$codNgc = $des->get_numGuiaE($folio);

       /*VERIFICAR DOCUMENOTO DE GUIA DE INGRESO */
          /*Insertar datos  */
          if($guia->Modificar($NUMERO, $CLIENTE, $TIPOSOLI, $CODIGO, $DETALLE, $newDate, $codNgc) == true){ /*MODIFICAR ESTADO EN DESCRIPCION*/
            if($codNge>0){
              if($guiaS->Update($nfecha,$NUMSAL,$des->get_numGuiaS($folio))){
                  if($des->modificarDes($folio, $Estado)){
                      echo  'Se han Modificado los datos con exito';
                  }
                  else {echo 'invalid';}
              }
              else{echo 'error';}
            }
            else{
               if($guiaS->InsertGuia($nfecha,$NUMSAL)){
                    $num = $guiaS->get_codMaximo ();
                    $des-> Modificar($folio, $num );
                    echo 'Se han Modificado los datos con exito';
                }else{echo 'error';}
           }
         }
         else{echo 'error';}
}

 ?>
