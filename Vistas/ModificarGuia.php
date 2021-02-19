<?php
session_start();
require_once("../Datos/Connection.php");
require_once("../Controller/ControladorCliente.php");
require_once("../Controller/ControladorSolicitud.php");
require_once("../Controller/ControladorEstado.php");
require_once('../Modelo/Busqueda.php');
require_once('../Modelo/GuiaSalida.php');
require_once('../Modelo/GuiaEntrada.php');
require_once('../Modelo/descripcion.php');
$busqueda = new Busqueda();
$des      = new descripcion_model();
$guiaS    = new GuiaSalida();
$guiaE    = new GuiaEntrada();
$fechaActual = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!--  <link rel="stylesheet" href="../css/Styleform.css">-->
    <link rel="stylesheet" href="../css/Stylemenu.css">
    <link rel="stylesheet"  href="../bootstrap-5.0.0-beta2-dist/css/bootstrap.min.css">
    <title>Registrar</title>
  </head>
  <body>
    <head>
        <?php  include('menu.php') ?>
        <br>
    </head>
    <?php
        $x = ($_GET['codigo']);
        if($des->Existe($x)){
          $buscar = $busqueda->BuscarDetalle($x);
          foreach ($buscar as $fol) {
            $folio     = $fol ['codFolio'];    $numero    = $fol ['codnumero'];    $codigo    = $fol ['codS'];
            $detalle   = $fol ['descripcion']; $fecha     = $fol ['fecha'];        $cliente   = $fol ['nomcliente'];
            $solicitud = $fol ['nombre'];      $nombreen  = $fol ['nomencargado']; $apellido  = $fol ['apellido'];
            $numS      = $fol ['numsal'];      $nfecha    = $fol ['fesal'];        $Estado    = $fol ['estado'];
            $docEnt    = $guiaE->NombreDocumento($numero);
            $docSal    = $guiaS->NombreDocumento($numS);
            /*Falta la informacion de la guia de salida*/
            $texto = substr($detalle, 0, 10);
            $palabras = explode(' ', $texto);
            $resultado = implode(' ', $palabras);
            $resultado .= '...';

            $fecha1 = date("Y-m-d", strtotime($fecha));
            $fecha2 = date("Y-m-d", strtotime($nfecha));
          }
        }
        else{
          $BuscarFol = $busqueda->get_BusquedaFolio($x);
          foreach ($BuscarFol as $fol){
            $numero    = $fol ['codnumero'];    $codigo    = $fol ['codS'];         $Estado    = $fol ['estado'];
            $detalle   = $fol ['descripcion'];  $fecha     = $fol ['fecha'];        $cliente   = $fol ['nomcliente'];
            $solicitud = $fol ['nombre'];       $nombreen  = $fol ['nomencargado']; $apellido  = $fol ['apellido'];
            $numS      = '';                    $nfecha    = '';                    $docEnt    = '';
            $docSal    = '';
            /*Falta la informacion de la guia de salida*/
            $texto = substr($detalle, 0, 10);
            $palabras = explode(' ', $texto);
            $resultado = implode(' ', $palabras);
            $resultado .= '...';

            $fecha1 = date("Y-m-d", strtotime($fecha));
            $fecha2 = $fechaActual;
          }
        }
      ?>
    <div class="container">
      <div class="col-9">
        <div class="col-5">
          <h2 class="my-2 display-7">Modificar datos</h2>
        </div>
      <form  id="ingresar" class="form" enctype="multipart/form-data" action="../logica/Modificar.php">
          <div class="col-5">
            <h3 class=" my-2 display-7 ">Datos de Ingreso</h2>
          </div>
          <div class="row mb-4">
            <label for="folio" class="col-sm-3 col-form-label">Numero de SC</label>
            <div class="col-sm-8">
              <input  class="form-control" type="text" id="folio" name="folio" value="<?php echo $x ?>" readonly>
            </div>
          </div>
          <div class="row mb-4">
             <label for="encargado" class="col-sm-3 col-form-label"> Encargado</label>
             <div class="col-sm-8">
                 <input class="form-control" value="<?php echo $nombreen.' '.$apellido ?>" readonly>
             </div>
          </div>
          <div class="row mb-4">
             <label for="numero" class="col-sm-3 col-form-label"> N°Guia</label>
             <div class="col-sm-8">
                 <input class="form-control" type="text" id="numero" name="numero" value=" <?php echo $numero ?> " >
             </div>
          </div>
          <div class="row mb-4">
             <label for="codigo" class="col-sm-3 col-form-label">Codigo Solped</label>
             <div class="col-sm-8">
                 <input style="text-transform:uppercase" class="form-control" type="text" id="codigo" name="codigo" value="<?php echo $codigo ?>" >
             </div>
          </div>
          <div class="row mb-4">
             <label for="fecha" class="col-sm-3 col-form-label">Fecha Ingreso</label>
             <div class="col-sm-8">
                 <input  class="form-control" type="date" id="fecha" name="fecha" value="<?php echo $fecha1 ?>">
             </div>
          </div>
          <div class="row mb-4">
             <label for="cliente" class="col-sm-3 col-form-label">Cliente</label>
             <div class="col-sm-8">
               <select class="form-select" id="cliente" name="cliente">
                   <option value="inicio">Seleccione una Opcion</option>
                   <?php
                     foreach ($datos as  $dato) {
                       if(strcasecmp($dato['nomcliente'], $cliente) == 0){
                         ?> <option value="<?php echo  $dato['codcliente'] ?>" selected><?php echo $dato['nomcliente'] ?></option>?> <?php
                       }
                       else{
                         ?> <option value="<?php echo $dato['codcliente'] ?>"><?php echo $dato['nomcliente'] ?></option>?> <?php
                       }
                     } ?>
                </select>
             </div>
           </div>
           <div class="row mb-4">
              <label for="solicitud" class="col-sm-3 col-form-label">Solicitud</label>
              <div class="col-sm-8">
                <select class="form-select" id="solicitud" name="solicitud">
                    <option value="inicio">Seleccione una Opcion</option>
                    <?php
                    foreach ($data as  $s) {
                      if(strcasecmp($s['nombre'] , $solicitud) == 0){
                        ?><option value="<?php echo $s['codigo'] ?>" selected><?php echo $s['nombre'] ?></option>?> <?php
                      }
                      else{
                        ?><option value="<?php echo $s['codigo']?>"><?php echo $s['nombre'] ?></option><?php
                      }
                 } ?>
                 </select>
              </div>
            </div>
            <div class="row mb-4">
               <label for="estado" class="col-sm-3 col-form-label">Estado</label>
               <div class="col-sm-8">
                 <select class="form-select" id="estado" name="estado">
                     <option value="inicio">Seleccione una Opcion</option>
                     <?php
                       foreach ($state as $estado) {
                         if(strcasecmp($estado['nombre'] , $Estado) == 0){
                           ?><option value="<?php echo $estado['codigo'] ?>" selected><?php echo $estado['nombre'] ?></option>?> <?php
                         }
                         else{
                           ?><option value="<?php echo  $estado['codigo']?>"><?php echo $estado['nombre'] ?></option><?php
                         }
                       }
                      ?>
                  </select>
               </div>
             </div>
             <div class="row mb-4">
                <label for="detalle" class="col-sm-3 col-form-label">Detalle</label>
                <div class="col-sm-8">
                    <textarea class="form-control" type="text" id="detalle" name="detalle"  maxlength="1000 "  cols="40" rows="5"><?php echo $detalle ?></textarea>
                </div>
             </div>
             <div class="row ">
               <label for="documentoA" class="col-sm-3 col-form-label">Documento Actual</label>
               <div class="col">
                 <p><?php echo  $docEnt ?></p>
               </div>
               <div class="col">
                     <div class="btn-group  " role="group" aria-label="Basic example">
                    <button class="btn btn-outline-danger float-left" type="button" name="button">Agregar</button>
                    <button class="btn btn-outline-danger float-left" type="button" name="button">Eliminar</button>
                     </div>
               </div>
             </div>

            <!------------------------------------------------------------------------------>
            <div class="col-5">
              <h3 class=" my-2 display-7 ">Datos de Egreso</h2>
            </div>
            <div class="row mb-4">
               <label for="fechasal" class="col-sm-3 col-form-label">Fecha Salida</label>
               <div class="col-sm-8">
                   <input class="form-control" type="date"  id="fechasal" name="fechasal" value="<?php echo $fecha2 ?>">
               </div>
            </div>
            <div class="row mb-4">
               <label for="numsal" class="col-sm-3 col-form-label">Numero de Guia</label>
               <div class="col-sm-8">
                   <input class="form-control" type="text" id="numsal" name="numsal" value="<?php echo $numS ; ?>">
               </div>
            </div>
            <div class="row">
               <label for="doc" class="col-sm-3 col-form-label">Documento Actual</label>
               <div class="col">
                   <p><?php echo $docSal ?></p>
               </div>
               <div class="col">
                     <div class="btn-group  " role="group" aria-label="Basic example">
                    <button class="btn btn-outline-danger float-left" type="button" name="button">Agregar</button>
                    <button class="btn btn-outline-danger float-left" type="button" name="button">Eliminar</button>
                     </div>
               </div>
            </div>
            <br>
            <div class="row">

              <div class="d-grid gap-3" >
                  <button class="btn btn-danger btn-lg btn-block" type="submit">Registrar</button>
              </div>
            </div>

      </form>
    </div>
  </div>
  <br><br>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script>
  $(document).ready(function (e) {
    $("#ingresar").on('submit',(function(e) {

      e.preventDefault();
      $.ajax({
       url: "../logica/Modificar.php",
       type: "POST",
       data:  new FormData(this),
       contentType: false,
       cache: false,
       processData:false,
       beforeSend : function()
       {
         $("#error").fadeOut();
       },
       success: function(data)
       {
         if(data=='invalid')
         {
           // formato de archivo invalido
           $("#error").html("Formato de archivo no valido").fadeIn();
         }
         else if (data == 'error') {
           $("#error").html("Error al ingresar los datos").fadeIn();
         }
         else
         {
           alert(data);
           $("#ingresar")[0].reset();
           location.href ="Inicio.php";
         }
       },
       error: function(e)
       {
         $("#error").html(e).fadeIn();
       }
     });
   }));
  });
  </script>
  <script>
        //script para las ventana de agregar archivo y eliminar archivo
  </script>
  <script src="../bootstrap-5.0.0-beta2-dist/js/bootstrap.min.js"></script>
  </body>
</html>
