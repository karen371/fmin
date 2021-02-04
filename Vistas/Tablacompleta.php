
<?php
session_start();
require_once("../Datos/Connection.php");
require_once("../Modelo/descripcion.php");

$des = new descripcion_model();

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/StyleMenu.css">
    <link rel="stylesheet" href="../css/StyleTablas.css">
    <title></title>
  </head>
  <body>
    <header>
        <?php  include('menu.php');?>
    </header>
        <h2></h2>
        <div class="ContenedorTabla">

            <table class="rwd-table">
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
              <th></th>
            </tr>
            </thead>
            <tbody>
        <?php
        $todo = $des->get_descripcionTodo();
        foreach ( $todo as $dato) {
          /*VARIABLES*/
          $folio     = $dato ['codFolio'];
          $numero    = $dato['codnumero'];
          $codigo    = $dato['codS'];
          $detalle   = $dato['descripcion'];
          $fecha     = $dato['fecha'];
          $cliente   = $dato['nomcliente'];
          $solicitud = $dato['nombre'];
          $nombreen  = $dato['nomencargado'];
          $apellido  = $dato['apellido'];
          /*LIMITE A MOSTRAR EN EL DETALLE*/
          $texto = substr($detalle, 0, 10);
          $palabras = explode(' ', $texto);
          $resultado = implode(' ', $palabras);
          $resultado .= '...';
          ?>
          <tr>
            <td><?php echo $folio;                ?></td>
            <td><?php echo $numero;               ?></td>
            <td style="text-transform:uppercase"><?php echo $codigo;               ?></td>
            <td><?php echo $nombreen.' '.$apellido?></td>
            <td><?php echo $solicitud;            ?></td>
            <td><?php echo $cliente;              ?></td>
            <td><?php echo $fecha ;                ?></td>
            <td><?php echo $resultado;            ?></td>
            <td>
               <a href="detalle.php?codigo=<?php echo $folio?>">Ver más</a>
            </td>
           </tr>
           <?php
         }
         ?>
         </tbody>
        </table>
        </div>

  </body>
</html>
