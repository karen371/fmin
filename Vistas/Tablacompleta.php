
<?php
require_once("../Datos/Connection.php");
require_once("../Modelo/descripcion.php");

$des = new descripcion_model();

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/StyleMenu.css">
    <link rel="stylesheet"  href="../bootstrap-5.0.0-beta2-dist/CSS/bootstrap.min.css">
    <link rel="stylesheet"  href="../css/datatables.min.css">
    <title></title>
  </head>
  <body>
        <h2></h2>
        <div class="container">

        <table id="example" class="table table-hover" style="width:100%">
            <thead class="table-danger">
            <tr>
              <th>SC</th>
              <th>N° Guia</th>
              <th>Codigo Solped</th>
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
            <td style="text-transform:uppercase"><?php echo $codigo;               ?></td>
            <td><?php echo $fecha ;                ?></td>
            <td><?php echo $nombreen.' '.$apellido?></td>
            <td><?php echo $cliente;              ?></td>
            <td><?php echo $solicitud;            ?></td>
            <td><?php echo $Estado;                ?></td>
            <td>
               <a href="detalle.php?codigo=<?php echo $folio?>" class="btn btn-danger btn-sm " role="button" aria-pressed="true">Ver</a>
            </td>
           </tr>
           <?php
         }
         ?>
         </tbody>
         <footer></footer>
        </table>
        </div>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="../bootstrap-5.0.0-beta2-dist/js/bootstrap.min.js"></script>
        <script src="../bootstrap-5.0.0-beta2-dist/js/datatables.min.js"></script>
        <script>
        $(document).ready(function() {
        $('#example').DataTable( {
          "language": {
            "lengthMenu": "Numero de filas _MENU_ ",
            "zeroRecords": "Sin Registros - lo sentimos",
            "info": "Pagina _PAGE_ de _PAGES_",
            "infoEmpty": "Sin registros disponibles",
            "infoFiltered": "(filtados _MAX_ total de registros)"
         },
            "columnDefs": [
                {
                    "targets": [ 2 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 3 ],
                    "visible": false
                }
            ]
          } );
        } );
        </script>
  </body>
</html>
