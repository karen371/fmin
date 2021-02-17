<?php
session_start();
require_once('../Datos/Connection.php');
require_once('../Modelo/Trabajador.php');
require_once('../Modelo/cliente.php');
require_once('../Modelo/Solicitud.php');
require_once('../Modelo/GuiaEntrada.php');
require_once('../Modelo/descripcion.php');
require_once('../Modelo/Estado.php');
$trabajador  = new Trabajador();
$CLI         = new cliente_model();
$SOL         = new solicitud_model();
$guia        = new GuiaEntrada();
$des         = new descripcion_model();
$estado      = new Estado();
// extenciones validas
$valid_extensions = array('jpeg', 'jpg', 'png', 'pdf' , 'doc' ,'txt', 'docx');
//directorio en el que se guardaran los archivos
$path = '../Archivos/';
/*verificar campos vacios*/

if($_POST['cliente'] == 'inicio' || $_POST['solicitud'] == 'inicio' || $_POST['estado'] == 'inicio'){
  echo 'error';
}
else {
  if(!empty($_POST['numero']) || !empty($_POST['codigo']) || !empty($_FILES['doc']) || !empty($_POST['detalle']) ||
   !empty($_POST['fecha']) || !empty($_POST['cliente']) || !empty($_POST['solicitud']) || !empty($_POST['estado']))
    {
      /*nombre de el documento y nombre temporal*/
      $doc = $_FILES['doc']['name'];
      $tmp = $_FILES['doc']['tmp_name'];
      /*devuelve la informacin del documento*/
      $ext = strtolower(pathinfo($doc, PATHINFO_EXTENSION));
      /*asignacion del nombre que se guardara el documento el cual sera numero de guia + nombre de el documento*/
      $doc_final = $_POST['numero'].''.$doc;
      //Validacion de formato valido
         if(in_array($ext, $valid_extensions))
         {
           /*devuelve los caracteres en minuscula*/
           $path = $path.strtolower($doc_final);
           /*Verifica que el archivo subido sea valido*/
           if(move_uploaded_file($tmp,$path)){
             /*VARIABLES*/
             $NUMERO   = $_POST['numero'];       $CODIGO   = $_POST['codigo'];     $FECHA    = $_POST['fecha'];
             $DETALLE  = $_POST['detalle'];      $CLIENTE  = $_POST['cliente'];    $TIPOSOLI = $_POST['solicitud'];
             $NOMEN    = $_SESSION['nombre'];    $APELEN   = $_SESSION['apellido']; $Estado  = $_POST['estado'];
             $newDate = date("d-m-Y", strtotime($FECHA)); /*cambiar formato de fecha*/
             //CODIGO DE TRABAJADOR
             $codTrab = $trabajador->get_codigo($NOMEN, $APELEN);
              /*Insertar datos  */
              if($guia->InsertGuia($NUMERO, $CLIENTE, $TIPOSOLI, $CODIGO, $DETALLE ,$newDate, $codTrab, $path ) == true){
                 /*SACAL EL NUMERO MAXIMO DE LA GUIA*/
                 $MaxGuia = $guia->get_codMaximo();
                 if($des->Insert($MaxGuia, $Estado) == true){
                   /*SACAL EL NUMERO MAXIMO DE LA DESCRIPCION*/
                   $MaxFolio = $des->get_codMaximo();
                   echo  'Se han ingresado los datos con exito, el  codigo SC es: '.$MaxFolio;
                 }
                 else{echo 'error';}
               }
               else{ echo 'error';}
           }
         }
         else {echo 'invalid';}
    }
    else{echo 'error';}

    }







?>
