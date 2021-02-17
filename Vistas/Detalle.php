<?php
  session_start();
  require_once('../Datos/Connection.php');
  require_once('../Modelo/Busqueda.php');
  require_once('../Modelo/GuiaSalida.php');
    require_once('../Modelo/GuiaEntrada.php');
  require_once('../Modelo/descripcion.php');

$busqueda = new Busqueda();
$guiaSali  = new descripcion_model();
$guiaEntra = new GuiaEntrada();
$guia      = new GuiaSalida();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
 <link rel="stylesheet" href="../css/StyleDetalle.css" type="text/css">
 <link rel="stylesheet" href="../css/StyleMenu.css" type="text/css">
  <title></title>
</head>
  <body>
    <?php include('menu.php');
    $x = ($_GET['codigo']);

    if($guiaSali->Existe($x)){
      $buscar = $busqueda->BuscarDetalle($x);
      foreach ($buscar as $fol) {
        $folio     = $fol ['codFolio'];    $numero    = $fol ['codnumero'];    $codigo    = $fol ['codS'];
        $detalle   = $fol ['descripcion']; $fecha     = $fol ['fecha'];        $cliente   = $fol ['nomcliente'];
        $solicitud = $fol ['nombre'];      $nombreen  = $fol ['nomencargado']; $apellido  = $fol ['apellido'];
        $numS      = $fol ['numsal'];      $nfecha    = $fol ['fesal'];        $estado    = $fol ['estado'];
        $documento = "<button type='button' name='button'>
                        <a href='../logica/descarga.php?archivos=".$guia->Documento($numS)."'>Descargar</a>
                      </button>";
        $nombreDoc = $guia->NombreDocumento($numS);
      }
    }
    else{
      $BuscarFol = $busqueda->get_BusquedaFolio($x);
      foreach ($BuscarFol as $fol){
        $folio     = $fol ['codFolio'];    $numero    = $fol ['codnumero'];    $codigo    = $fol ['codS'];
        $detalle   = $fol ['descripcion']; $fecha     = $fol ['fecha'];        $cliente   = $fol ['nomcliente'];
        $solicitud = $fol ['nombre'];      $nombreen  = $fol ['nomencargado']; $apellido  = $fol ['apellido'];
        $estado = $fol ['estado'];         $numS      = '';                    $nfecha    = '';
        $documento = ' ';                  $nombreDoc = ' ';
      }
    }
?>
<div class="">
   <nav>
     <ul>
       <li><a href="ModificarGuia.php?codigo=<?php echo $folio?>"><span class="icon-suitcase"></span>Modificar Guia</a></li>
       <li><a href="Inicio.php"><span class="icon-suitcase"></span>Imprimir</a></li>
     </ul>
   </nav>
</div>
<div class="Separacion">
   <h2>Detalle Ingreso</h2>
</div>
<div class="content">
 <table>
   <tr>
     <th><label>SC</label></th>
     <td><label><?php echo $folio;  ?></label></td>
   </tr>
   <tr>
     <th><label>N° Guia</label></th>
     <td><label><?php echo $numero; ?></label></td>
   </tr>
   <tr>
     <th><label>Codigo Solped</label></th>
     <td><label style="text-transform:uppercase"><?php echo $codigo; ?></label></td>
   </tr>
   <tr>
     <th><label>Encargado Ingreso</label></th>
     <td><label><?php echo $nombreen.' '.$apellido; ?></label></td>
   </tr>
   <tr>
     <th><label>Fecha Ingreso</label></th>
     <td><label><?php echo $fecha;  ?></label></td>
   </tr>
   <tr>
     <th><label>Tipo Solicitud</label></th>
     <td><label><?php echo $solicitud; ?></label></td>
   </tr>
   <tr>
     <th><label>Cliente</label> </th>
     <td><label><?php echo $cliente;?></label></td>
   </tr>
   <tr>
     <th><label>Estado</label> </th>
     <td><label><?php echo $estado;?></label></td>
   </tr>
   <tr >
     <th><label>Detalle</label></th>
     <td ><label><?php echo $detalle ?> </label></td>
   </tr>
   <tr>
     <td> <label for=""> Fotos con descripcion</label> </td>
   </tr>
   <tr>
     <th><label>Guia de despacho</label></th>
     <td><label><?php echo $guiaEntra->NombreDocumento($numero) ?></label></td>
     <td><label>
         <button type="button" name="button">
         <a href='../logica/descarga.php?archivos=<?php$guiaEntra->Documento($numero)?>'>Descargar</a>
       </button>
       </label></td>
   </tr>
 </table>
 <div class="Separar">
     <h2>Detalle Egreso</h2>
 </div>
 <table>
   <tr>
     <th><label>Fecha de Egreso</label></th>
     <td><label><?php echo $nfecha; ?></label></td>
   </tr>
   <tr>
     <th><label>N° de guia</label></th>
     <td><label><?php echo $numS; ?></label></td>
   </tr>
   <tr>
     <th><label>Guia de despacho</label></th>
     <td><label><?php echo $nombreDoc; ?></label></td>
     <td><label><?php echo $documento ?></label></td>
   </tr>
   <tr>
     <td> <label for=""> Fotos con descripcion</label> </td>
   </tr>
 </table>
</div>
  </body>
  <footer>
    <br><br><br>
  </footer>
</html>
<!--ARREGLAR LOS BOTONES DE DESCARGAS PONERLOS PRESENTABLES-->
