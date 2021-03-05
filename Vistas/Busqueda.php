<?php /*PRINCIPAL*/
require_once('../Datos/Connection.php');
require_once('../Modelo/Busqueda.php');
session_start();
$buscar = new Busqueda();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/Stylemenu.css" type="text/css">
    <link rel="stylesheet"  href="../bootstrap-5.0.0-beta2-dist/CSS/bootstrap.min.css">
    <title></title>
  </head>
  <body>
    <head>
      <?php include('menu.php');?>
    </head>
    <div class="container">
      <?php
      if($_GET){
        $q     = $_GET['Search']; /*REALIZAR UN FILTRADO POR OT*/
        $Efol  = $buscar->ExisteFolio($q);
        $Eguia = $buscar->ExisteGuia($q);
        $style='';
        ?>
        <table id = 'tabla' class="table table-hover" style=<?php echo $style ?>>
          <p class="h4 fw-bold" style=<?php echo $style ?>>Resultados para  "<?php echo $q ;?> "</p>
          <thead class="table-danger">
            <tr>
              <th>SC</th>
              <th>N° Guia</th>
              <th>Fecha Ingreso</th>
              <th>Encargado Ingreso</th>
              <th>Cliente</th>
              <th>Tipo Solicitud</th>
              <th>Estado</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
          <?php
            if ($Eguia == true){
              $BuscarGuia = $buscar->get_BusquedaGuia($q);
              foreach ($BuscarGuia as $Guia) {
                $folio     = $Guia ['codFolio'];    $numero    = $Guia ['codnumero'];    $codigo    = $Guia ['codS'];
                $detalle   = $Guia ['descripcion']; $fecha     = $Guia ['fecha'];        $cliente   = $Guia ['nomcliente'];
                $solicitud = $Guia ['nombre'];      $nombreen  = $Guia ['nomencargado']; $apellido  = $Guia ['apellido'];
                $Estado    = $Guia['nombre'];
                $texto = substr($detalle, 0, 10);
                $palabras = explode(' ', $texto);
                $resultado = implode(' ', $palabras);
                $resultado .= '...';
          ?>
                <tr>
                  <td><?php echo $folio; ?></td>
                  <td><?php echo $numero;?></td>
                  <td><?php echo $fecha;?></td>
                  <td><?php echo $nombreen.' '.$apellido?></td>
                  <td><?php echo $cliente; ?></td>
                  <td><?php echo $solicitud;?></td>
                  <td><?php echo $Estado                ?></td>
                  <td>
                    <a href="detalle.php?codigo=<?php echo $folio?>" class="btn btn-danger btn-sm " role="button" aria-pressed="true">Ver</a>
                  </td>
                </tr>
          <?php
          }
        }
        else  if($Efol == true){
          $BuscarFol = $buscar->get_BusquedaFolio($q);
          foreach ($BuscarFol as $fol){
            $folio     = $fol ['codFolio'];    $numero    = $fol ['codnumero'];    $codigo    = $fol ['codS'];
            $detalle   = $fol ['descripcion']; $fecha     = $fol ['fecha'];        $cliente   = $fol ['nomcliente'];
            $solicitud = $fol ['nombre'];      $nombreen  = $fol ['nomencargado']; $apellido  = $fol ['apellido'];
            $Estado    = $fol ['estado'];
            $texto = substr($detalle, 0, 10);
            $palabras = explode(' ', $texto);
            $resultado = implode(' ', $palabras);
            $resultado .= '...';
        ?>
            <tr>
              <td><?php echo $folio; ?></td>
              <td><?php echo $numero;?></td>
              <td><?php echo $fecha;?></td>
              <td><?php echo $nombreen.' '.$apellido?></td>
              <td><?php echo $cliente; ?></td>
              <td><?php echo $solicitud;?></td>
              <td><?php echo $Estado                ?></td>
              <td>
                <a href="detalle.php?codigo=<?php echo $folio?>" class="btn btn-danger btn-sm " role="button" aria-pressed="true">Ver</a>
              </td>
            </tr>
          <?php
          }
        }
      }
       ?>
          </tbody>
        </table>
    </div>
  </body>
</html>
