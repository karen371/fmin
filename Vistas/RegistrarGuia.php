<?php
/*FALTA EL ENCARGADO EL CUAL SE PUEDE SACAR DIRECTAMENTE DE EL SESSION[]*/
session_start();
require_once('../Datos/Connection.php');
require_once("../Datos/Connection.php");
require_once("../Controller/ControladorCliente.php");
require_once("../Controller/ControladorSolicitud.php");
require_once("../Controller/ControladorEstado.php");

$fechaActual = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0/css/bootstrap.min.css">
    <!-- Latest minified bootstrap js -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../css/StyleMenu.css">

    <link rel="stylesheet" href="../bootstrap-5.0.0-beta2-dist/css/bootstrap.min.css">

    <title>Registrar</title>
  </head>
  <body>
        <?php  include('menu.php');?>
    <div class="container">
      <div class="col-12"></div>
      <div class="col-3"></div>
      <div class="col-9">
        <p class="text-center my-4 display-5">Guia de Despacho</p>
             <form id="ingresar" action="../logica/registrarguia.php" method="post" enctype="multipart/form-data" class="form">
             <div class="row mb-3">
              <label for="numero" class="col-sm-3 col-form-label">N° Guia</label>
              <div class="col-sm-9">
              <input  class="form-control" type="text" id="numero" name="numero" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="codigo" class="col-sm-3 col-form-label">Código Solped</label>
              <div class="col-sm-9">
              <input style="text-transform:uppercase" class="form-control" type="text"   id="codigo" name="codigo">
              </div>
            </div>
            <div class="row mb-3">
              <label for="fecha" class="col-sm-3 col-form-label">Fecha Ingreso</label>
              <div class="col-sm-9">
              <input class="form-control" type="date"  id="fecha" name="fecha" value="<?php echo $fechaActual ?>">
              </div>
            </div>
            <div class="row mb-3">
              <label for="cliente" class="col-sm-3 col-form-label">Cliente</label>
              <div class="col-sm-8">
              <select class="form-select" id="cliente" name="cliente">
                <option value='inicio'>Seleccione una Opcion</option>
                 <?php foreach ($datos as $key => $dato) {?>
                    <option value="<?php echo  $dato['codcliente']?>"><?php echo $dato['nomcliente']?></option>
                 <?php }?>
              </select>
              </div>
              <div class="col-sm-1"><button class="btn btn-success btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#modalFormCli">+</button></div>
            </div>
            <div class="row mb-3">
              <label for="solicitud" class="col-sm-3 col-form-label">Tipo Solicitud</label>
              <div class="col-sm-8">
                <select class="form-select" id="solicitud" name="solicitud">
                  <option value='inicio'>Seleccione una Opcion</option>
                  <?php foreach ($data as $key => $s) {?>
                    <option value="<?php echo $s['codigo']  ?>"><?php echo $s['nombre'] ?></option><?php }?>
                </select>
              </div>
              <div class="col-sm-1">
                               <div class="col-sm-1"><button class="btn btn-success btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#modalFormSol">+</button></div>
              </div>
            </div>
            <div class="row mb-3">
              <label for="estado" class="col-sm-3 col-form-label">Estado</label>
              <div class="col-sm-8">
              <select class="form-select" id="estado" name="estado">
                <option value='inicio'>Seleccione una Opcion</option>
                <?php foreach ($state as $estado) {?>
                    <option value="<?php echo $estado['codigo'] ?>"><?php echo $estado['nombre'] ?></option>
                <?php };?>
              </select>
              </div>
              <div class="col-sm-1">
                    <div class="col-sm-1"><button class="btn btn-success btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#modalFormEst">+</button></div>
              </div>
            </div>

             <div class="row mb-3">
              <label for="detalle" class="col-sm-3 col-form-label">Detalle</label>
              <div class="col-sm-9">
              <textarea class="form-control" type="text" id="detalle" name="detalle"  maxlength="1000 "  cols="40" rows="5"></textarea>
              </div>
             </div>

             <div class="row mb-3">
              <label for="doc" class="col-sm-3 col-form-label">Documento</label>
              <div class="col-sm-9">
              <input id="uploadImage" class="form-control" type="file" accept=".doc,.docx,.pdf,.txt" name="doc" />
              </div>
            </div>
            <p id="error"></p>

            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-danger btn-lg btn-block" type="submit">Registrar</button>
          </form>
        </div>
    </div>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../bootstrap-5.0.0-beta2-dist/js/bootstrap.min.js"></script>

  <!--VENTADA MODAL DE CLIENTE-->
  <div class="modal fade" id="modalFormCli" tabindex="-1" aria-labelledby="FormModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ingresar cliente</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form class="form" role="form">
            <p>Nombre Cliente</p>
            <input type="text" class="form-control" id="nomCliente" name="nomCliente" required/>
        </form>
        </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="button" class="btn  btn-danger" onclick="submitCliente()">Guardar</button>
          </div>
        </div>
    </div>
  </div>
<!--VENTADA MODAL DE SOLICITUD-->
<div class="modal fade" id="modalFormSol" tabindex="-1" aria-labelledby="FormModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ingresar Solicitud</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form class="form" role="form">
          <p>Nueva Solicitud</p>
          <input type="text" class="form-control" id="nomSolicitud" name="nomSolicitud" required/>
      </form>
      </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn  btn-danger" onclick="submitSolicitud()">Guardar</button>
        </div>
      </div>
  </div>
</div>
<!--VENTADA MODAL DE ESTADO-->
<div class="modal fade" id="modalFormEst" tabindex="-1" aria-labelledby="FormModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ingresar Estado</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form class="form" role="form">
          <p>Nuevo Estado</p>
          <input type="text" class="form-control" id="nomSolicitud" name="nomSolicitud" required/>
      </form>
      </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn  btn-danger" onclick="submitEstado()">Guardar</button>
        </div>
      </div>
  </div>
</div>
<!---Script--->
      <script>
      //registro de guia de despacho
      $(document).ready(function (e) {
         $("#ingresar").on('submit',(function(e) {
           e.preventDefault();
           $.ajax({
            url: "../logica/registrarguia.php",
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
              if(data =='invalid')
              {
                $("#error").html("Formato de archivo invalido").fadeIn(); // formato de archivo invalido
              }
              else if (data.mensaje == 'error') {
                alert('Error en los datos ingresados');
                // $("#error").html("").fadeIn(); // formato de archivo invalido
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
      /*---------------INCREGAR UN NUEVO CLIENTE---------------*/
      function submitCliente(){
        var nomCliente = $('#nomCliente').val();
        if(nomCliente.trim() == ''){
          $('.error').html('<span style="color:red;">*Campo Vacio.</p>');
          $('#nomCliente').focus();
        }
        else {
          $.ajax({
            type:'POST',
            url:'../logica/InsertCliente.php',
            data:'&nomCliente='+nomCliente,
            beforeSend: function () {
              $('.submitBtn').attr("disabled","disabled");
              $('.modal-body').css('opacity', '.5');
            },
            success:function(data){
              if(data == 'ok'){
                $('.statusMsg').html('<span style="color:green;">Ingresado Correctamente.</p>');
                load();
                refresh('#modalFormCli');
              }
              else{
                $('.statusMsg').html('<span style="color:red;">Error al ingresar los datos.</p>');
                refresh('#modalFormCli');
              }
            }
          });
          refresh('#modalFormCli');
        }
           }
      /*---------------REFRESCAR LOS SELECT (CLIENTE, SOLICITUD Y ESTADO)---------------*/
      function refresh(modal){
          $(modal).on('hidden.bs.modal', function (e) {
            var modal = $(this)
              modal.find('.statusMsg').text('');
              modal.find('input').val('');
              modal.find('input').val('');
              $('.submitBtn').removeAttr("disabled");
              $('.modal-body').css('opacity', '');¿
          });
      }
      /*----------ELIMINAR LA LISTA DE CLIENTES DE EL SELECT---------------*/
      function EliminarCliente(){
         var cliente = $("#cliente");
         $('option').each(function() {
            if ( cliente.val() != '' ) {
              cliente.find('option').remove();
            }
         });
        }
       /*---------------CARGAR DATOS CLIENTE---------------*/
      function load(){
          EliminarCliente();
             $.post("get_Cliente.php", function(data){
               $("#cliente").html(data);
            });
      }
      /*---------------INCREGAR UN NUEVA SOLICITUD---------------*/
      function submitSolicitud(){
             var nomSolicitud = $('#nomSolicitud').val();
             if(nomSolicitud.trim() == ''){
               $('.error').html('<span style="color:red;">*Campo Vacio.</p>');
               $('#nomSolicitud').focus();
             }
             else {
               $.ajax({
                 type:'POST',
                 url:'../logica/InsertSolicitud.php',
                 data:'&nomSolicitud='+nomSolicitud,
                 beforeSend: function () {
                   $('.submitBtn').attr("disabled","disabled");
                   $('.modal-body').css('opacity', '.5');
                 },
                 success:function(data){
                   if(data == 'ok'){
                     $('.statusMsg').html('<span style="color:green;">Ingresado Correctamente.</p>');
                     loadSol();
                     refresh('#modalFormSol');
                   }
                   else{
                     $('.statusMsg').html('<span style="color:red;">Error al ingresar los datos.</p>');
                     refresh('#modalFormSol');
                   }
                 }
               });
               refresh('#modalFormSol');
             }
           }
           /*----------ELIMINAR LA LISTA DE CLIENTES DE EL SELECT---------------*/
           function EliminarSolicitud(){
              var solicitud = $("#solicitud");
              $('option').each(function() {
                 if ( solicitud.val() != '' ) {
                   solicitud.find('option').remove();
                 }
              });
             }
           /*---------------CARGAR DATOS SOLICITUD---------------*/
           function loadSol(){
               EliminarSolicitud();
                  $.post("get_Solicitud.php", function(data){
                    $("#solicitud").html(data);
                 });
           }
           /*---------------INCREGAR UN NUEVA SOLICITUD---------------*/
           function submitEstado(){
                  var nomEstado = $('#nomEstado').val();
                  if(nomEstado.trim() == ''){
                    $('.error').html('<span style="color:red;">*Campo Vacio.</p>');
                    $('#nomEstado').focus();
                  }
                  else {
                    $.ajax({
                      type:'POST',
                      url:'../logica/InsertEstado.php',
                      data:'&nomEstado='+nomEstado,
                      beforeSend: function () {
                        $('.submitBtn').attr("disabled","disabled");
                        $('.modal-body').css('opacity', '.5');
                      },
                      success:function(data){
                        if(data == 'ok'){
                          $('.statusMsg').html('<span style="color:green;">Ingresado Correctamente.</p>');
                          loadEst();
                          refresh('#modalFormEst');
                        }
                        else{
                          $('.statusMsg').html('<span style="color:red;">Error al ingresar los datos.</p>');
                          refresh('#modalFormEst');
                        }
                      }
                    });
                    refresh('#modalFormEst');
                  }
                }
                /*----------ELIMINAR LA LISTA DE CLIENTES DE EL SELECT---------------*/
                function EliminarEstado(){
                   var Estado = $("#estado");
                   $('option').each(function() {
                      if ( Estado.val() != '' ) {
                        Estado.find('option').remove();
                      }
                   });
                  }
                /*---------------CARGAR DATOS SOLICITUD---------------*/
                function loadEst(){
                    EliminarEstado();
                       $.post("get_Estado.php", function(data){
                         $("#estado").html(data);
                      });
                }
      </script>
      <script src="../bootstrap-5.0.0-beta2-dist/js/bootstrap.min.js"></script>
  </body>
</html>
