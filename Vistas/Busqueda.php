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
    <link rel="stylesheet" href="../css/Styletablas.css" type="text/css">
    <link rel="stylesheet" href="../css/StyleMenu.css" type="text/css">
    <title></title>
  </head>
  <body>
    <head>
      <?php include('menu.php');?>
    </head>
<?php
?>
  <div class="ContenedorTabla">
    <table class="rwd-table">
      <?php
      if($_GET) {
        $q     = $_GET['Search']; /*REALIZAR UN FILTRADO POR OT*/
        $Efol  = $buscar->ExisteFolio($q);
        $Eguia = $buscar->ExisteGuia($q);
        if($Efol == true){
          $BuscarFol = $buscar->get_BusquedaFolio($q);
          foreach ($BuscarFol as $fol) {
            $folio     = $fol ['codFolio'];    $numero    = $fol ['codnumero'];    $codigo    = $fol ['codS'];
            $detalle   = $fol ['descripcion']; $fecha     = $fol ['fecha'];        $cliente   = $fol ['nomcliente'];
            $solicitud = $fol ['nombre'];      $nombreen  = $fol ['nomencargado']; $apellido  = $fol ['apellido'];

            $texto = substr($detalle, 0, 10);
            $palabras = explode(' ', $texto);
            $resultado = implode(' ', $palabras);
            $resultado .= '...';
            ?>
            <thead>
              <tr>
                <th>SC</th>
                <th>N° Guia</th>
                <th>Codigo Solped</th>
                <th>Encargado Ingreso</th>
                <th>Tipo Solicitud</th>
                <th>Cliente</th>
                <th>Fecha Ingreso</th>
                <th>Detalle</th>
                <th>Ver más</th>
               </tr>
             </thead>
             <tbody>
                <tr>
                  <td><?php echo $folio; ?></td>
                  <td><?php echo $numero;?></td>
                  <td><?php echo $codigo;?></td>
                  <td><?php echo $nombreen.' '.$apellido?></td>
                  <td><?php echo $solicitud;?></td>
                  <td><?php echo $cliente; ?></td>
                  <td><?php echo $fecha;?></td>
                  <td><?php echo $resultado;?></td>
                  <td>
                    <a href="detalle.php?codigo=<?php echo $folio?>">Ver más</a>
                  </td>
                </tr>
              </tbody>
              <?php
           }/*FIN foreach*/
          }
          else if ($Eguia == true){
            $BuscarGuia = $buscar->get_BusquedaGuia($q);
            foreach ($BuscarGuia as $Guia) {
              $folio     = $Guia ['codFolio'];    $numero    = $Guia ['codnumero'];    $codigo    = $Guia ['codS'];
              $detalle   = $Guia ['descripcion']; $fecha     = $Guia ['fecha'];        $cliente   = $Guia ['nomcliente'];
              $solicitud = $Guia ['nombre'];      $nombreen  = $Guia ['nomencargado']; $apellido  = $Guia ['apellido'];

              $texto = substr($detalle, 0, 10);
              $palabras = explode(' ', $texto);
              $resultado = implode(' ', $palabras);
              $resultado .= '...';
              ?>
              <thead>
                <tr>
                  <th>SC</th>
                  <th>N° Guia</th>
                  <th>Codigo Solped</th>
                  <th>Encargado Ingreso</th>
                  <th>Tipo Solicitud</th>
                  <th>Cliente</th>
                  <th>Fecha Ingreso</th>
                  <th>Detalle</th>
                  <th>Ver más</th>
                 </tr>
               </thead>
               <tbody>
                  <tr>
                    <td><?php echo $folio; ?></td>
                    <td><?php echo $numero;?></td>
                    <td><?php echo $codigo;?></td>
                    <td><?php echo $nombreen.' '.$apellido?></td>
                    <td><?php echo $solicitud;?></td>
                    <td><?php echo $cliente; ?></td>
                    <td><?php echo $fecha;?></td>
                    <td><?php echo $resultado;?></td>
                    <td>
                      <a href="detalle.php?codigo=<?php echo $folio?>">Ver más</a>
                    </td>
                  </tr>
                </tbody>
                <?php
             }/*FIN foreach*/
          }
          else{
            ?>
            <h2>No se han encontrado resultados con <?php echo $q ;?></h2>
            <?php
          }
        }
       ?>
    </table>
  </div>
