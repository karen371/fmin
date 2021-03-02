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
    <div class="container ">
      <div class="row">


      <?php
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
        $numGuiaE  = $guiaSali->get_numGuiaE($x);
        $docEnt    = $guiaEntra ->NombreDocumento($numGuiaE);
        $numGuiaS  = $guiaSali-> get_numGuiaS($x);
        $nombreDoc    = $guia->NombreDocumento($numGuiaS);

      }
      ?>
      <div class="row pt-4">
          <div class="col">
            <div class="mx-auto"> <h2>Detalle</h2></div>
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
        $numGuiaE  = $guiaSali->get_numGuiaE($x);
        $docEnt    = $guiaEntra ->NombreDocumento($numGuiaE);
      }
      ?>
      <div class="row pt-4">
          <div class="col">
            <div class="mx-auto"> <h2>Detalle </h2></div>
          </div>
          <div class="col"> </div>
          <div class="col-6">
                <div class="btn-group  " role="group" aria-label="Basic example">
                  <a href="ModificarGuia.php?codigo=<?php echo $folio?>" class="btn btn-outline-danger float-left" role="button"><span class="icon-suitcase"></span>Modificar</a>
                  <a class="btn btn-outline-danger float-left" href="RegistrarEgreso.php?codigo=<?php echo $folio?>"><span class="icon-suitcase"></span>Ingresar Guia</a>
                  <a class="btn btn-outline-danger float-left"  onclick="imprimir()"><span class="icon-suitcase"></span>Imprimir</a>
                </div>
          </div>
      </div>
      <?php
    }
?>
<br>

<div class="col-8">
<div class="mx-auto"> <h2>Detalle Egreso</h2> </div>
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
    <div class="col"> <label><?php echo $docEnt?></label></div>
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
  <div class="col">
    <!--IMAGENES-->
    <?php
      $imagenes= $guiaSali->MostrarImagen($folio);
      foreach ($imagenes as  $i){
      $direccion =  $i['imagen']; $id = $i['codimg']; $descipcion = $i['descripcion'];
    //  $direccion = ; $codimagen = $i['codimg'];$detalle = ;
    ?>
        <div class="card" style="width: 18rem; height: 18rem;">
          <img src="<?php echo $direccion ?>" class="card-img-top" alt="..." style="width: 250px; height: 200px;">
          <div class="card-body">
            <p class="card-text"><?php echo $descipcion ?></p>
          </div>
        </div>
    <?php
    }
    ?>
  </div>

  </div>
  </div>
  </body>
  <script src="../bootstrap-5.0.0-beta2-dist/js/bootstrap.min.js"></script>
  <script type="text/javascript">
  function imprimir(){
if (parseInt(navigator.appVersion)>4)
  window.print();
}
  </script>
  </body>
</html>
<!--ARREGLAR LOS BOTONES DE DESCARGAS PONERLOS PRESENTABLES-->
