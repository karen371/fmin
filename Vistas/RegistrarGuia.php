<?php
/*FALTA EL ENCARGADO EL CUAL SE PUEDE SACAR DIRECTAMENTE DE EL SESSION[]*/
session_start();
require_once('../Datos/Conexion.php');
require_once("../Datos/Connection.php");
require_once("../Controller/ControladorCliente.php");
require_once("../Controller/ControladorSolicitud.php");
require_once("../Controller/ControladorEstado.php");
$con = new Conexion();
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
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Latest minified bootstrap js -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../css/Styleform.css">
    <link rel="stylesheet" href="../css/StyleMenu.css">
    <title>Registrar</title>
  </head>
  <body>
    <head>
        <?php  include('menu.php');?>
        <!--SE PUEDE CRER OTRO MENU CON PEQUEÑOS ICONOS QUE INDIQUEN LA SOLICITUD -->
    </head>
    <div class="contenedor">
      <form id="ingresar" action="../logica/registrarguia.php" method="post" enctype="multipart/form-data" class="form">
          <table>
            <tr>
              <th colspan="2"><h2 class="titulo">Guia de Despacho</h2></th>
              <th></th>
            </tr>
          <tr>
            <td><label> N° Guia </label></td>
            <td class="td"><input  class="input" type="text" id="numero" name="numero" required></td>
            <td></td>
          </tr>
          <tr>
            <td><label> Código Solped </label></td>
            <td><input style="text-transform:uppercase" class="input" type="text"   id="codigo" name="codigo"></td>
            <td></td>
          </tr>
          <tr>
            <td><label> Fecha Ingreso </label></td>
            <td><input class="input" type="date"  id="fecha" name="fecha" value="<?php echo $fechaActual ?>"></td>
            <td></td>
          </tr>
          <tr>
            <td><label>Cliente</label></td>
            <td>
             <select id="cliente" name="cliente">
               <?php
                 foreach ($datos as $key => $dato) {
                   ?><option id="<?php $dato['nomcliente']?>"><?php echo $dato['nomcliente'] ?></option><?php }?>
             </select>
            </td>
            <td></td>
          </tr>
          <tr>
            <td><label>Tipo Solicitud</label></td>
            <td>
              <select id="solicitud" name="solicitud">
                <?php
                foreach ($data as $key => $s) {
                  ?><option id="<?php $s['nombre']  ?>"><?php echo $s['nombre'] ?></option><?php }?>
              </select>
            </td>
            <td>
                <button class="boton"  data-toggle="modal" data-target="#FormModal">Agregar solicitud</button>
            </td>
          </tr>
          <tr>
            <td><label>Estado</label></td>
            <td>
              <select id="estado" name="estado">
                <?php
                  foreach ($state as $estado) {
                    ?> <option id="<?php $estado['nombre'] ?>"><?php echo $estado['nombre'] ?></option> }<?php
                  }
                 ?>
              </select>
            </td>
          </tr>
          <tr >
            <td><label>Detalle</label></td>
            <td rowspan="2"><textarea class="textarea" type="text" id="detalle" name="detalle"  maxlength="1000 "  cols="40" rows="5"></textarea></td>
            <td></td>
          </tr>
          <tr>
            <th></th>
            <td></td>
          </tr>
          <tr>
            <td><label>Documento</label></td>
            <td>
              <input id="uploadImage" type="file" accept=".doc,.docx,.pdf,.txt" name="doc" /> <!--cabiar nombre-->
            </td>
            <td></td>
          </tr>
          <tr>
            <td> <label></label></td>
            <td><div id="preview" style="color:red;"></div><br></td>
          </tr>
          <tr>
            <td colspan="2"><button class="button" type="submit">Registrar</button></td>
            <td></td>
            <td></td>
          </tr>
      </table>
    </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script>
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
         $("#preview").fadeOut();
         $("#err").fadeOut();
       },
       success: function(data)
       {
         if(data=='invalid')
         {
           $("#preview").html("Formato de archivo invalido").fadeIn(); // formato de archivo invalido
         }
         else if (data == 'error') {
            $("#preview").html("Error en los datos ingresados").fadeIn(); // formato de archivo invalido
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
         $("#preview").html(e).fadeIn();
       }
     });
   }));
});
  </script>
<!--VENTADA MODAL DE SOLICITUD-->
<div class="modal fade" id="FormModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">×</span>
              <span class="sr-only">Cerrar</span>
          </button>
              <h3 class="titulos" id="myModalLabel">Ingresar Solicitud</h3>
        </div>
          <div class="contenedor">
              <form class="form" role="form">
                  <div>
                    <table>
                      <tr>
                        <td><label>Nombre Cliente</label></td>
                      </tr>
                      <tr>
                        <td><input type="text" class="input" id="nomCliente" name="nomCliente" required/></td>
                      </tr>
                    </table>
                  </div>
              </form>
          </div>
          <div class="modal-footer">
              <button type="submit" class="boton"  data-dismiss="modal">Cancelar</button>
              <button type="submit" class="boton"  onclick="submitForm()">Guardar</button>
          </div>
      </div>
  </div>
</div>
<!--script CORRESPONDIENTE A VENTANA DE SOLICITUD-->
<script>
function submitForm(){
  var nomCliente= $('#nomCliente').val();
  if(nomCliente.trim() == '' ){
      alert('Ingresar el nombre de el cliente.');
      $('#nomCliente').focus();
      return false;
  }
  }else{
      $.ajax({
          type:'POST',
          url:'../logica/Estado.php', //cambiar
          data:'nomCliente='+nomCliente,
          beforeSend: function () {
              $('.submitBtn').attr("disabled","disabled");
              $('.modal-body').css('opacity', '.5');
          },
          success:function(msg){
            if(msg == 'ok'){
                $('#nomCliente').val('');
                $('.statusMsg').html('<span style="color:green;">Thanks for contacting us, well get back to you soon.</p>');
            }else{
                $('.statusMsg').html('<span style="color:red;">Some problem occurred, please try again.</span>');
            }
            $('.submitBtn').removeAttr("disabled");
            $('.modal-body').css('opacity', '');
          }
      });
  }
}
</script>
  </body>
</html>
