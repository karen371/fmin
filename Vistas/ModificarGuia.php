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
        $style = "";
        $disabled = "";
        $bandera = "false";
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
        $style = "readonly";
        $disabled = "disabled";
        $bandera = "true";
      }
    }

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
    </head>
    <br>
    <div class="container d-flex justify-content-center pt-5">
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
             <p id="docEnt"><?php echo  $docEnt ?></p>
           </div>
           <div class="col">
                 <div class="btn-group  " role="group" aria-label="Basic example">
                <button class="btn btn-outline-danger float-left" type="button" data-bs-toggle="modal" data-bs-target="#modalAgregarE" name="AgregarE" id="AgregarE">Agregar</button>
                <button class="btn btn-outline-danger float-left" type="button" name="EliminarE" id="EliminarE" >Eliminar</button>
                 </div>
           </div>
         </div>
     <hr color="blue" size=3>
    <div class="jumbotron">
        <!------------------------------------------------------------------------------>
        <div class="col-5">
          <h3 class=" my-2 display-7 ">Datos de Egreso</h2>
        </div>
        <div class="row mb-4">
           <label for="numsal" class="col-sm-3 col-form-label">Numero de Guia</label>
           <div class="col-sm-8">
               <input class="form-control" type="text" id="numsal" name="numsal" value="<?php echo $numS ; ?>" <?php echo $style ?>>
           </div>
        </div>
        <div class="row mb-4">
           <label for="fechasal" class="col-sm-3 col-form-label">Fecha Salida</label>
           <div class="col-sm-8">
               <input class="form-control" type="date"  id="fechasal" name="fechasal" value="<?php echo $fecha2 ?>" <?php echo $style ?>>
           </div>
        </div>
        <div class="row">
           <label for="doc" class="col-sm-3 col-form-label">Documento Actual</label>
           <div class="col">
               <p id="docSal"><?php echo $docSal ?></p>
           </div>
           <div class="col">
              <div class="btn-group" role="group" aria-label="Basic example">
                <button class="btn btn-outline-danger float-left <?php echo $disabled ?>" type="button" data-bs-toggle="modal" data-bs-target="#modalAgregarS" name="AgregarS" id="AgregarS" aria-disabled="<?php echo $bandera ?>">Agregar</button>
                <button class="btn btn-outline-danger float-left <?php echo $disabled ?>" type="button" name="EliminarS" id="EliminarS" aria-disabled="<?php echo $bandera ?>">Eliminar</button>
              </div>
           </div>
        </div>
        <br><br>
        <div class="row">
          <div class="d-grid gap-3" >
              <button class="btn btn-danger btn-lg btn-block" type="submit">Modificar</button>
          </div>
        </div>
  </form>
</div>
</div>
<!--INGREGAR GUIA DE ENTRADA-->
   <div class="modal fade" id="modalAgregarE" tabindex="-1" aria-labelledby="FormModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ingresar Guia de Entrada</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form class="form" role="form" enctype="multipart/form-data">
            <!--<label class="col-form-label">Archivo</label>-->
            <input type="file" class="form-control" id="docE" name="docE" required/>
            <div class="invalid-feedback" id="mistake"></div>
            <div class="valid-feedback" id="Right"></div>
        </form>
        </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Cancelar</button>
              <button type="button" class="btn  btn-danger" onclick="submitAgregarE()">Guardar</button>
          </div>
        </div>
    </div>
  </div>
<!--INGREGAR GUIA DE SALIDA-->
<div class="modal fade" id="modalAgregarS" tabindex="-1" aria-labelledby="FormModal" aria-hidden="true">
 <div class="modal-dialog">
   <div class="modal-content">
   <div class="modal-header">
       <h5 class="modal-title" id="exampleModalLabel">Ingresar Guia de Salida</h5>
       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <div class="modal-body">
     <form class="form" role="form" enctype="multipart/form-data">
         <input type="file" class="form-control" id="doc" name="doc" required />
     </form>
     </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Cancelar</button>
           <button type="button" class="btn  btn-danger" onclick="submitAgregarS()">Guardar</button>
       </div>
     </div>
 </div>
</div>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="../bootstrap-5.0.0-beta2-dist/js/bootstrap.min.js"></script>
<script>
$(document).ready(function (e) {
$("#ingresar").on('submit',(function(e) {
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
   e.preventDefault();
}));
});
$("#EliminarE").click(function(){
   //  var formData = new FormData();
     var clave = "EliminarE";
     //formData.append("folio", $("#numsal").val());
     var folio = $("#folio").val();
     var doc = "<?php echo $docEnt?>"
 $.ajax({
    url : "../logica/ModificarDocumento.php", //pasar el folio, archivo
    data : "&clave="+clave+"&folio="+folio+"&doc="+doc,
    type : "post",
    beforeSend : function()
    {
          $("#docEnt").html("").fadeOut();
    },
    success: function(data)
    {
      if(data == "error"){
        alert('Error al ingresar el archivo');
      }
      else{
         $("#docEnt").html("").fadeIn();
         alert(data);
         ///*Colocar el documento subido COLOCAR UN beforeSend*/
      }
    }
  })
});
$("#EliminarS").click(function(){
  var clave = "EliminarS";
  var folio = $("#folio").val();
  var doc = "<?php echo  $docSal ?>";
 $.ajax({
   url : "../logica/ModificarDocumento.php", //pasar el folio, archivo
   data : "&clave="+clave+"&folio="+folio+"&doc="+doc,
   type : "post",
   beforeSend : function()
   {
         $("#docSal").html("").fadeOut();
   },
   success: function(data)
   {
     if(data == "error"){
       alert("Error al eliminar el archivo");
     }
     else{
       $("#docSal").html("").fadeIn();
      alert(data);
     }
   }
 })
});

function submitAgregarE(){
 var data = new FormData();
/*jQuery.each($('input[type=file]')[0].files, function(i, file) {
   data.append('file-'+i, file);
});*/
var file_data = $('input[type = "file"]')[0].files;
 for(var i =0; i < file_data.length; i++){
   data.append("docE", file_data[i]);
 }
 data.append("clave","AgregarE");
 data.append("folio",$("#folio").val());
 data.append("numero", $("#numero").val());
jQuery.ajax({
   url: '../logica/ModificarDocumento.php',
   data: data,
   cache: false,
   contentType: false,
   processData: false,
   type: 'POST',
   beforeSend : function()
   {
         $("#docEnt").html("").fadeOut();
   },
   success: function(data){
     if(data == "error"){
       alert('Error al ingresar el archivo');
     }
     else{
       var documento = "<?php echo $guiaE->Documento($numero);?>";
       $("#docEnt").html("").fadeIn();/*Colocar el documento subido*/
     alert(data);
     }
   }
});
}
 function submitAgregarS(){
   var data = new FormData();
   data.append("clave","AgregarS");
   data.append("folio",$("#folio").val());
   data.append("numsal", $("#numsal").val());

   var file_data = $('#doc')[0].files;
   for(var i =0; i < file_data.length; i++){
     data.append("doc", file_data[i]);
   }

 jQuery.ajax({
     url: '../logica/ModificarDocumento.php',
     data: data,
     cache: false,
     contentType: false,
     processData: false,
     type: 'POST',
     beforeSend : function()
     {
           $("#docSal").html("").fadeOut();
     },
     success: function(data){
       if(data == "error"){
         alert('Error al ingresar el archivo');
       }
       else{

       var documento = "<?php echo $guiaS->NombreDocumento($numS);?>";
       $("#docSal").html(documento).fadeIn();/*Colocar el documento subido*/
       alert(data);
       }
     }
 });
 }
</script>
</body>
</html>
