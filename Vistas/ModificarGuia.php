<?php
/*FALTA EL ENCARGADO EL CUAL SE PUEDE SACAR DIRECTAMENTE DE EL SESSION[]*/
session_start();
require_once("../Datos/Connection.php");
require_once('../Datos/Conexion.php');
require_once("../Controller/ControladorCliente.php");
require_once("../Controller/ControladorSolicitud.php");
require_once("../Controller/ControladorEstado.php");
require_once('../Modelo/Busqueda.php');
require_once('../Modelo/GuiaSalida.php');
require_once('../Modelo/GuiaEntrada.php');
require_once('../Modelo/descripcion.php');
$fechaActual = date('Y-m-d');

$busqueda = new Busqueda();
$des      = new descripcion_model();
$guiaS    = new GuiaSalida();
$guiaE    = new GuiaEntrada();
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
    <link rel="stylesheet" href="../css/Styleform.css">
    <link rel="stylesheet" href="../css/StyleMenu.css">
    <title>Registrar</title>
  </head>
  <body>
    <head>
        <?php  include('menu.php') ?>
    </head>
    <?php
        $x = ($_GET['codigo']);
        if($des->Existe($x)){
          $buscar = $busqueda->BuscarDetalle($x);
          foreach ($buscar as $fol) {
            $folio     = $fol ['codFolio'];    $numero    = $fol ['codnumero'];    $codigo    = $fol ['codS'];
            $detalle   = $fol ['descripcion']; $fecha     = $fol ['fecha'];        $cliente   = $fol ['nomcliente'];
            $solicitud = $fol ['nombre'];      $nombreen  = $fol ['nomencargado']; $apellido  = $fol ['apellido'];
            $numS      = $fol ['numsal'];      $nfecha    = $fol ['fesal'];
            $docEnt    = $guiaE->NombreDocumento($numero);  $docSal = $guiaS->NombreDocumento($numS);
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
            $numero    = $fol ['codnumero'];    $codigo    = $fol ['codS'];
            $detalle   = $fol ['descripcion']; $fecha     = $fol ['fecha'];        $cliente   = $fol ['nomcliente'];
            $solicitud = $fol ['nombre'];      $nombreen  = $fol ['nomencargado']; $apellido  = $fol ['apellido'];
            $numS      = '';                   $nfecha    = ''; $docEnt='';  $docSal='';
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

    <div class="contenedor">
      <form  id="ingresar" class="form" enctype="multipart/form-data" action="../logica/Modificar.php">
          <table>
            <tr>
              <th colspan="2"><h1 class="titulos">Modificar</h1></th>
              <br>
            </tr>
            <tr>
              <td colspan="2"><h3 class="titulos">Datos de Ingreso</h3></td>
              <td></td>
            </tr>
            <tr>
              <!--pasar a la pagina modificar si cambiar el dato -->
              <td><label> Numero de SC </label></td>
              <td><input  class="input" id="folio" name="folio" value="<?php echo $x ?>" ></td>
            </tr>
            <tr>
              <td><label> Encargado </label></td>
              <td><input class="input" disabled="disabled" value="<?php echo $nombreen.' '.$apellido ?>"></td>
            </tr>
            <tr>
              <td><label> N° Guia </label></td>
              <td class="td"><input  class="input" type="text" id="numero" name="numero" value=" <?php echo $numero ?> "></td>
            </tr>
            <tr>
              <td><label> Código Solped </label></td>
              <td><input style="text-transform:uppercase"  class="input" type="text" id="codigo" name="codigo" value="<?php echo $codigo ?>"></td>
            </tr>
            <tr>
              <td><label> Fecha Ingreso </label></td>
              <td><input class="input" type="date"  id="fecha" name="fecha" value="<?php echo $fecha1 ?>"></td>
            </tr>
            <tr>
              <td><label>Cliente</label></td>
              <td>
                <!--Imprimir desde la base de datos-->
                <select id="cliente" name="cliente">
                  <?php
                    foreach ($datos as  $dato) {
                      if(strcasecmp($dato['nomcliente'], $cliente) == 0){
                        ?> <option id="<?php $dato['nomcliente'] ?>" selected><?php echo $dato['nomcliente'] ?></option>?> <?php
                      }
                      else{
                        ?> <option id="<?php $dato['nomcliente'] ?>"><?php echo $dato['nomcliente'] ?></option>?> <?php
                      }
                    } ?>
                </select>
            </tr>
            <tr>
              <td><label>Tipo Solicitud</label></td>
              <td>
                <select id="solicitud" name="solicitud">
                  <?php
                  foreach ($data as  $s) {
                    if(strcasecmp($s['nombre'] , $solicitud) == 0){
                      ?><option id="<?php $s['codigo'] ?>" selected><?php echo $s['nombre'] ?></option>?> <?php
                    }
                    else{
                      ?><option id="<?php $s['codigo']?>"><?php echo $s['nombre'] ?></option><?php
                    }
               } ?>
                </select>
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
              <td  rowspan="2"><textarea class="textarea" type="text" id="detalle" name="detalle"  maxlength="1000 "  cols="40" rows="5"><?php echo $detalle ?></textarea></td>
            </tr>
            <tr>
              <th></th>
              <td></td>
            </tr>
            <tr>
              <td><label>Documento actual</label></td>
              <td> <?php echo  $docEnt ?> </td>
            </tr>
            <tr>
              <td><label>Subir Documento</label></td>
              <td>
                <input id="" type="file" accept=".doc,.docx,.pdf,.txt" name="docIng" />
              </td>
            </tr>
            <!------------------------------------------------------------------------------>
            <tr>
              <td colspan="2"><h3 class="titulos" colspan="2">Datos de Egreso</h3></td>
              <td></td>
            </tr>
            <tr>
              <td><label> Fecha Entrega (Salida) </label></td>
              <td><input class="input" type="date"  id="fechasal" name="fechasal" value="<?php echo $fecha2 ?>"></td>
            </tr>
            <tr>
              <td><label> Numero de Guia </label></td>
              <td><input class="input" type="text" id="numsal" name="numsal" value="<?php echo $numS ; ?>"></td>
            </tr>
            <tr>
              <td> <label>Documento</label></td>
              <td><?php echo $docSal ?></td>
            </tr>
            <tr>
              <td><label>Subir Documento</label></td>
              <td>
                <input id="uploadImage" type="file" accept=".doc,.docx,.pdf,.txt" name="doc" />
                <div id="error" style="color:red"></div><br>
              </td>
            </tr>
            <tr>
              <td colspan="2"><button class="button" type="submit">Guardar</button></td>
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
  </body>
</html>
