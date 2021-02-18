
<?php
require_once("../Datos/Connection.php");
require_once("../Modelo/descripcion.php");

$des = new descripcion_model();
?>
    <h2></h2>
    <div class="container">
        <table class="table table-hover">
        <thead class="table-danger">
        <tr>
          <th>SC</th>
          <th>N° Guia</th>
          <th>Fecha Ingreso</th>
      <!--    <th>Codigo Solped</th>-->
          <th>Encargado Ingreso</th>
          <th>Cliente</th>
          <th>Tipo Solicitud</th>
          <th>Estado</th>
        <!--  <th>Detalle</th>-->
          <th></th>
        </tr>
      </thead>
        <tbody>
    <?php
    $datos = $des->get_descripcion();
    foreach ($datos as $dato) {
      /*VARIABLES*/
      $folio     = $dato['codFolio'];
      $numero    = $dato['codnumero'];
      $codigo    = $dato['codS'];
      $detalle   = $dato['descripcion'];
      $fecha     = $dato['fecha'];
      $cliente   = $dato['nomcliente'];
      $solicitud = $dato['nombre'];
      $nombreen  = $dato['nomencargado'];
      $apellido  = $dato['apellido'];
      $Estado    = $dato['estado'];
      /*LIMITE A MOSTRAR EN EL DETALLE*/
      $texto = substr($detalle, 0, 10);
      $palabras = explode(' ', $texto);
      $resultado = implode(' ', $palabras);
      $resultado .= '...';
      ?>
      <tr>
        <td><?php echo $folio;                ?></td>
        <td><?php echo $numero;               ?></td>
        <td><?php echo $fecha ;                ?></td>
      <!--  <td style="text-transform:uppercase"><?php echo $codigo;?></td>-->
        <td><?php echo $nombreen.' '.$apellido?></td>
        <td><?php echo $cliente;              ?></td>
        <td><?php echo $solicitud;            ?></td>
        <td><?php echo $Estado                ?></td>

      <!--  <td><?php echo $resultado;            ?></td>-->
        <td>
           <a href="detalle.php?codigo=<?php echo $folio?>" class="btn btn-danger btn-sm " role="button" aria-pressed="true">Ver</a>
        </td
       </tr>
       <?php
     }
     ?>
     <tfoot>
       <tr>
         <td colspan="5">
           <div class="d-grid gap-2 d-md-block">
              <a class="btn btn-danger btn-block " role="button" aria-pressed="true" href="Tablacompleta.php">Ver tabla completa</a>
            </div>
         </td>
         <td></td><td></td>
       </tr>
     </tfoot>
     </tbody>
    </table>
  </div>
