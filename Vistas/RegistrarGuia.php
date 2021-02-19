<?php
/*FALTA EL ENCARGADO EL CUAL SE PUEDE SACAR DIRECTAMENTE DE EL SESSION[]*/
session_start();
// require_once('../Datos/Connection.php');
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

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0/css/bootstrap.min.css"> -->
    <!-- Latest minified bootstrap js -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0/js/bootstrap.min.js"></script> -->
    <link rel="stylesheet" href="../bootstrap-5.0.0-beta2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/Stylemenu.css">

    <title>Registrar</title>
  </head>
  <body>
        <?php  include('menu.php');?>
    <div class="container">
      <div class="col-12"></div>
      <div class="col-3"></div>
      <div class="col-9">
        <p class="text-center my-4 display-5">Guia de Despacho</p>
             <!-- <form id="ingresar" action="../logica/registrarguia.php" method="post" enctype="multipart/form-data" class="form"> -->
             <div action="../logica/registrarguia.php" enctype="multipart/form-data" class="form">

             <div class="row mb-3">
              <label for="numero" class="col-sm-3 col-form-label">*N° Guia</label>
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
              <label for="cliente" class="col-sm-3 col-form-label">*Cliente</label>
              <div class="col-sm-8">
              <select class="form-select" id="cliente" name="cliente">
                <option value='inicio'>Seleccione una Opcion</option>
                 <?php
                 var_dump($datos);
                 foreach ($datos as $key => $dato) {?>
                    <option value="<?php echo  $dato['codcliente']?>"><?php echo $dato['nomcliente']?></option>
                 <?php }?>
              </select>
              <div class="invalid-feedback" id="mistake1"></div>
              </div>
              <div class="col-sm-1"><button class="btn btn-success btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#modalFormCli">+</button></div>
            </div>
            <div class="row mb-3">
              <label for="solicitud" class="col-sm-3 col-form-label">*Tipo Solicitud</label>
              <div class="col-sm-8">
                <select class="form-select" id="solicitud" name="solicitud">
                  <option value='inicio'>Seleccione una Opcion</option>
                  <?php foreach ($data as $key => $s) {?>
                    <option value="<?php echo $s['codigo']  ?>"><?php echo $s['nombre'] ?></option><?php }?>
                </select>
                <div class="invalid-feedback" id="mistake2"></div>
              </div>
              <div class="col-sm-1">
                               <div class="col-sm-1"><button class="btn btn-success btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#modalFormSol">+</button></div>
              </div>
            </div>
            <div class="row mb-3">
              <label for="estado" class="col-sm-3 col-form-label">*Estado</label>
              <div class="col-sm-8">
              <select class="form-select" id="estado" name="estado">
                <option value='inicio'>Seleccione una Opcion</option>
                <?php foreach ($state as $estado) {?>
                    <option value="<?php echo $estado['codigo'] ?>"><?php echo $estado['nombre'] ?></option>
                <?php };?>
              </select>
              <div class="invalid-feedback" id="mistake3"></div>
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
              <label for="doc" class="col-sm-3 col-form-label">*Documento</label>
              <div class="col-sm-9">
              <input id="doc" class="form-control" type="file" accept=".doc,.docx,.pdf,.txt" name="doc" />
              <div class="invalid-feedback " id="mistake4"></div>
              </div>
             </div>
             <div class="invalid-feedback " id="mistake4"></div>
          <div class="row mb-3">
            <label for="doc" class="col-sm-3 col-form-label"></label>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-danger btn-lg btn-block" type="button"  id="ingresar">Registrar</button>
            </div>
          <!-- </form> -->
          </div>
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
            <label class="col-form-label">Nombre Cliente</label>
            <input type="text" class="form-control" id="nomCliente" name="nomCliente" required/>
            <div class="invalid-feedback" id="mistake"></div>
            <div class="valid-feedback" id="Right"></div>
        </form>
        </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="refresh('#modalFormCli')">Cancelar</button>
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
          <label class="col-form-label">Nombre Solicitud</label>
          <input type="text" class="form-control" id="nomSolicitud" name="nomSolicitud" required/>
          <div class="invalid-feedback" id="mistake6"></div>
          <div class="valid-feedback" id="Right1"></div>
      </form>
      </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="refresh('#modalFormSol')" >Cancelar</button>
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
          <label class="col-form-label">Nuevo Estado</label>
          <input type="text" class="form-control" id="nomEstado" name="nomEstado" required/>
          <div class="invalid-feedback" id="mistake7"></div>
          <div class="valid-feedback" id="Right2"></div>
      </form>
      </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="refresh('#modalFormEst')" >Cancelar</button>
            <button type="button" class="btn  btn-danger" onclick="submitEstado()">Guardar</button>
        </div>
      </div>
  </div>
</div>
<!---Script--->
      <script>
      //registro de guia de despacho
      // $(document).ready(function (e) {
         $("#ingresar").on('click',(function(e) {
          var formData = new FormData();
              formData.append("numero", $("#numero").val());
              formData.append("codigo", $("#codigo").val());
              formData.append("fecha", $("#fecha").val());
              formData.append("cliente", $("#cliente").val());
              formData.append("solicitud", $("#solicitud").val());
              formData.append("estado", $("#estado").val());
              formData.append("detalle", $("#detalle").val());

              var file_data = $('input[type="file"]')[0].files;
               for (var i = 0; i < file_data.length; i++) {
                formData.append("doc", file_data[i]);
               }
              // formData.append("doc",$('input[type=file]')[0].files[0]);
              // console.log(formData.get("doc"));
           $.ajax({
            url: "../logica/registrarguia.php",
            type: "POST",
            data: formData,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            beforeSend : function()
            {
                $("#mistake").fadeOut();
            },
            success: function(data)
            {
              if(data.mensaje == 'invalid')
              {
                 $("#mistake4").html("*Formato de archivo invalido o campo vacio").fadeIn(); // formato de archivo invalido
              }
              else if (data.mensaje == 'error2') {
                var cliente   =  $("#cliente").val();
                var solicitud =  $("#solicitud").val()
                var estado    =  $("#estado").val()
                if(cliente.trim() == 'inicio'){
                  $("#mistake1").html("*Campos obligatorios").fadeIn();
                  $("#cliente").focus();
                }
                if(solicitud.trim() == 'inicio'){
                  $("#mistake2").html("*Campos obligatorios").fadeIn();
                  $("#solicitud").focus();
                }
                if(estado.trim() == 'inicio'){
                  $("#mistake3").html("*Campos obligatorios").fadeIn();
                  $("#estado").focus();
                }
              //  $(".invalid-feedback").html("*Campos obligatorios").fadeIn();
              }
              else if(data.mensaje == 'error'){
                  $("#mistake5").html("Error al ingrear los datos").fadeIn();
              }
              else
              {
                alert(data.mensaje);
                // $("#ingresar")[0].reset();
                location.href ="Inicio.php";
              }
            },
            error: function(e)
            {
              $("#mistake").html(e).fadeIn();
            }
          });
          e.preventDefault();
        }));
      // });
      /*---------------INCREGAR UN NUEVO CLIENTE---------------*/
      function submitCliente(){
        var nomCliente = $('#nomCliente').val();
        if(nomCliente.trim() == ''){
          $('#mistake').html('*Campo Vacio').fadeIn();
          $('#nomCliente').focus();
        }
        else {
          $.ajax({
            type:'POST',
            url:'../logica/InsertCliente.php',
            data:'&nomCliente='+nomCliente,
            beforeSend: function () {
              $('#mistake').fadeOut();
              $('#Right').fadeOut();
              $('.submitBtn').attr("disabled","disabled");
              $('.modal-body').css('opacity', '.5');
            },
            success:function(data){
              if(data == 'ok'){
                $('#Right').html('Ingresado Correctamente').fadeIn();
                load();
                refresh('#modalFormCli');
              }
              else{
                $('#mistake').html('Error al ingresar los datos.').fadeIn();
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
              modal.find('#Right').text('');
              modal.find('#mistake').text('');
              modal.find('#Right1').text('');
              modal.find('#mistake6').text('');
              modal.find('#Right2').text('');
              modal.find('#mistake7').text('');
              modal.find('input').val('');
              modal.find('input').val('');
              $('.submitBtn').removeAttr("disabled");
              $('.modal-body').css('opacity', '');
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
             $.post("../Controller/get_Cliente.php", function(data){
               $("#cliente").html(data);
            });
      }
      /*---------------INCREGAR UN NUEVA SOLICITUD---------------*/
      function submitSolicitud(){
        var nomSolicitud = $('#nomSolicitud').val();
        if(nomSolicitud.trim() == ''){
          $('#mistake6').html('*Campo Vacio').fadeIn();
          $('#nomSolicitud').focus();
        }
        else {
          $.ajax({
            type:'POST',
            url:'../logica/InsertSolicitud.php',
            data:'&nomSolicitud='+nomSolicitud,
            beforeSend: function () {
              $('#mistake6').fadeOut();
              $('#Right1').fadeOut();
              $('.submitBtn').attr("disabled","disabled");
              $('.modal-body').css('opacity', '.5');
            },
            success:function(data){
              if(data == 'ok'){
                $('#Right1').html('Ingresado Correctamente').fadeIn();
                load();
                refresh('#modalFormCli');
              }
              else{
                $('#mistake6').html('Error al ingresar los datos.').fadeIn();
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
                  $.post("../Controller/get_Solicitud.php", function(data){
                    $("#solicitud").html(data);
                 });
           }
           /*---------------INCREGAR UN NUEVA SOLICITUD---------------*/
           function submitEstado(){
                  var nomEstado = $('#nomEstado').val();
                  if(nomEstado.trim() == ''){
                    $('#mistake7').html('*Campo Vacio.').fadeIn();
                    $('#nomEstado').focus();
                  }
                  else {
                    $.ajax({
                      type:'POST',
                      url:'../logica/InsertEstado.php',
                      data:'&nomEstado='+nomEstado,
                      beforeSend: function () {
                        $('#mistake7').fadeOut();
                        $('#Right2').fadeOut();
                        $('.submitBtn').attr("disabled","disabled");
                        $('.modal-body').css('opacity', '.5');
                      },
                      success:function(data){
                        if(data == 'ok'){
                          $('#Right2').html('Ingresado Correctamente.').fadeIn();
                          loadEst();
                          refresh('#modalFormEst');
                        }
                        else{
                          $('#mistake7').html('Error al ingresar los datos.').fadeIn();
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
                       $.post("../Controller/get_Estado.php", function(data){
                         $("#estado").html(data);
                      });
                }
      </script>

  </body>
</html>
