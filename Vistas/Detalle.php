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
$fechaActual = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../bootstrap-5.0.0-beta2-dist/css/bootstrap.min.css">
 <link rel="stylesheet" href="../css/StyleDetalle.css" type="text/css">
 <link rel="stylesheet" href="../css/Stylemenu.css" type="text/css">
  <title></title>
</head>
  <body>
    <?php include('menu.php');
    ?>
    <div class="container"><?php
    $x = ($_GET['codigo']);

    if($guiaSali->Existe($x)){
      /*BLOQUEAR EL BOTON DE INGRESAR GUIA*/
      $BOTTON = "disabled";
      $buscar = $busqueda->BuscarDetalle($x);
      foreach ($buscar as $fol) {
        $folio     = $fol ['codFolio'];    $numero    = $fol ['codnumero'];    $codigo    = $fol ['codS'];
        $detalle   = $fol ['descripcion']; $fecha     = $fol ['fecha'];        $cliente   = $fol ['nomcliente'];
        $solicitud = $fol ['nombre'];      $nombreen  = $fol ['nomencargado']; $apellido  = $fol ['apellido'];
        $numS      = $fol ['numsal'];      $nfecha    = $fol ['fesal'];        $estado    = $fol ['estado'];
        $documento = "<a class='btn btn-danger btn-sm' href='../logica/descarga.php?archivos= echo".$guia->Documento($numS)."'>Descargar</a>";
        $nombreDoc = $guia->NombreDocumento($numS);
      }
      ?>
      <div class="row pt-4">
          <div class="col">
            <div class="mx-auto"> <h2>Detalle Ingreso</h2></div>
          </div>
          <div class="col"> </div>
          <div class="col-6">
                <div class="btn-group  " role="group" aria-label="Basic example">
                  <a href="ModificarGuia.php?codigo=<?php echo $folio?>" class="btn btn-outline-danger float-left " role="button" ><span class="icon-suitcase"></span>Modificar</a>
                  <a class="btn btn-outline-danger float-left disabled" href="RegistrarEgreso.php?codigo=<?php echo $folio?>" aria-disabled="true"><span class="icon-suitcase"></span>Ingresar Guia</a>
                  <a class="btn btn-outline-danger float-left" href="Inicio.php"><span class="icon-suitcase"></span>Imprimir</a>
                </div>
          </div>
      </div>
      <?php
    }
    else{
      $BuscarFol = $busqueda->get_BusquedaFolio($x);
      foreach ($BuscarFol as $fol){
        $folio     = $fol ['codFolio'];    $numero    = $fol ['codnumero'];    $codigo    = $fol ['codS'];
        $detalle   = $fol ['descripcion']; $fecha     = $fol ['fecha'];        $cliente   = $fol ['nomcliente'];
        $solicitud = $fol ['nombre'];      $nombreen  = $fol ['nomencargado']; $apellido  = $fol ['apellido'];
        $estado = $fol ['estado'];         $numS      = '';                    $nfecha    = '';
        $documento = ' ';                  $nombreDoc = '';
      }
      ?>
      <div class="row pt-4">
          <div class="col">
            <div class="mx-auto"> <h2>Detalle Ingreso</h2></div>
          </div>
          <div class="col"> </div>
          <div class="col-6">
                <div class="btn-group  " role="group" aria-label="Basic example">
                  <a href="ModificarGuia.php?codigo=<?php echo $folio?>" class="btn btn-outline-danger float-left" role="button"><span class="icon-suitcase"></span>Modificar</a>
                  <a class="btn btn-outline-danger float-left" href="RegistrarEgreso.php?codigo=<?php echo $folio?>"><span class="icon-suitcase"></span>Ingresar Guia</a>
                  <a class="btn btn-outline-danger float-left" href="Inicio.php"><span class="icon-suitcase"></span>Imprimir</a>
                </div>
          </div>
      </div>
      <?php
    }
?>
  <div class="row">
      <div class="col "> <label class="fw-bold">SC</label> </div>
      <div class="col"> <label><?php echo $folio;  ?></label> </div>
      <div class="col"> </div>
  </div>
  <div class="row">
    <div class="col"> <label class="fw-bold">N° Guia</label> </div>
    <div class="col"> <label><?php echo $numero; ?></label> </div>
    <div class="col"> </div>
  </div>
  <div class="row">
    <div class="col"> <label class="fw-bold">Codigo Solped</label> </div>
    <div class="col"> <label style="text-transform:uppercase"><?php echo $codigo; ?></label> </div>
    <div class="col"> </div>
  </div>
  <div class="row">
    <div class="col"> <label class="fw-bold">Encargado Ingreso</label>  </div>
    <div class="col"> <label><?php echo $nombreen.' '.$apellido; ?></label> </div>
    <div class="col"> </div>
  </div>
  <div class="row">
    <div class="col"> <label class="fw-bold">Fecha Ingreso</label>  </div>
    <div class="col"> <label><?php echo $fecha;  ?></label> </div>
    <div class="col"> </div>
  </div>
  <div class="row">
    <div class="col">  <label class="fw-bold">Tipo Solicitud</label>  </div>
    <div class="col"> <label><?php echo $solicitud; ?></label>  </div>
    <div class="col"> </div>
  </div>
  <div class="row">
    <div class="col"> <label class="fw-bold">Cliente</label>  </div>
    <div class="col"> <label><?php echo $cliente;?></label> </div>
    <div class="col"> </div>
  </div>
  <div class="row">
    <div class="col"> <label class="fw-bold">Estado</label> </div>
    <div class="col"> <label><?php echo $estado;?></label>  </div>
    <div class="col"> </div>
  </div>
  <div class="row">
    <div class="col"> <label class="fw-bold">Detalle</label>
    </div>
    <div class="col"> <label><?php echo $detalle ?> </label> </div>
    <div class="col"> </div>
  </div>
  <div class="row">
    <div class="col"> <label class="fw-bold">Guia de despacho</label> </div>
    <div class="col"> <label><?php echo $guiaEntra->NombreDocumento($numero) ?></label> </div>
    <div class="col"> <label>
                            <a class="btn btn-danger btn-sm" href='../logica/descarga.php?archivos=<?php echo $guiaEntra->Documento($numero)?>'>Descargar</a>
                      </label>
    </div>
  </div>
<div class="mx-auto"> <h2>Detalle Egreso</h2> </div>
<div class="row">
  <div class="col"> <label class="fw-bold">N° de guia</label> </div>
  <div class="col"> <label><?php echo $numS; ?></label> </div>
  <div class="col"> </div>
</div>
  <div class="row">
    <div class="col"> <label class="fw-bold">Fecha de Egreso</label> </div>
    <div class="col"> <label ><?php echo $nfecha; ?></label> </div>
    <div class="col">   </div>
  </div>
  <div class="row">
      <div class="col"> <label class="fw-bold">Guia de despacho</label>   </div>
      <div class="col"> <label><?php echo $nombreDoc; ?></label>  </div>
      <div class="col"> <label><?php echo $documento ?></label>   </div>
  </div>
  <br>
</div>
  </body>

  <script src="../bootstrap-5.0.0-beta2-dist/js/bootstrap.min.js"></script>
  </body>
</html>
<!--ARREGLAR LOS BOTONES DE DESCARGAS PONERLOS PRESENTABLES-->
