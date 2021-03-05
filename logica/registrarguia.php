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
//$valid_extensions = array('jpeg', 'jpg', 'png', 'pdf' , 'doc' ,'txt', 'docx');
//directorio en el que se guardaran los archivos
//$path = '../Archivos/';

/*verificar campos vacios*/

if($_POST['cliente'] == 'inicio' || $_POST['solicitud'] == 'inicio' || $_POST['estado'] == 'inicio'){
  $jsondata['mensaje'] = "error2";
}
else{
  if(!empty($_POST['numero'])){
    /*        $CODIGO   = $_POST['codigo'];*/

        $NOMEN    = $_SESSION['nombre'];    $APELEN   = $_SESSION['apellido'];
        $NUMERO   = $_POST['numero'];  $CODIGO   = $_POST['codigo']; $FECHA    = $_POST['fecha'];
        $DETALLE  = $_POST['detalle']; $CLIENTE  = $_POST['cliente'];  $TIPOSOLI = $_POST['solicitud'];
        $Estado  = $_POST['estado'];   $newDate = date("d-m-Y", strtotime($FECHA));
        $codTrab = $trabajador->get_codigo($NOMEN, $APELEN);
        /*Insertar datos  */
        if($guia->InsertGuia($NUMERO, $CLIENTE, $TIPOSOLI, $CODIGO, $DETALLE ,$newDate, $codTrab ) == true){
          /*SACAL EL NUMERO MAXIMO DE LA GUIA*/
          try {
            $MaxGuia = $guia->get_codMaximo();
          }catch (Exception $e) {
            $jsondata['mensaje'] = "error";
          }
          if($des->Insert($MaxGuia, $Estado) == true){
            $MaxFolio = $des->get_codMaximo();
             $jsondata['mensaje'] = 'Se han ingresado los datos con exito, el  codigo SC es: '.$MaxFolio;
          }

        }
        else{$jsondata['mensaje'] = "error";}
   }
   else{
     $jsondata['mensaje'] = "error";
   }
}

header("Content-Type: application/json", true);
 echo json_encode($jsondata);

?>
