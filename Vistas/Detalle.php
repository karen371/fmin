<?php
    session_start();
    require_once('../Datos/Connection.php');
    require_once('../Modelo/Busqueda.php');
    require_once('../Modelo/GuiaSalida.php');
    require_once('../Modelo/GuiaEntrada.php');
    require_once('../Modelo/descripcion.php');






    $busqueda  = new Busqueda();
    $guiaSali  = new descripcion_model();
    $guiaEntra = new GuiaEntrada();
    $guia      = new GuiaSalida();
    $fechaActual = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>



    <link rel="stylesheet" href="../bootstrap-5.0.0-beta2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/StyleDetalle.css" type="text/css">
    <link rel="stylesheet" href="../css/Stylemenu.css" type="text/css">
    <title></title>
</head>
<body>
    <?php include('menu.php');?>
    <div class="container">
      <div class="table">
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
                $numGuiaS  = $guiaSali-> get_numGuiaS($x);
                $nombreDoc    = $guia->NombreDocumento($numGuiaS);
                $numGuiaE  = $guiaSali->get_numGuiaE($x);
                $docEnt    = $guiaEntra ->NombreDocumento($numGuiaE);
                if($nombreDoc == ''){
                  $documento='';
                }
                else if($nombreDoc != ''){
                  $documento = "<a class='btn btn-danger btn-sm' href='../logica/descarga.php?archivos= echo".$guia->Documento($numS)."'>Descargar</a>";
                }
                if($docEnt == ''){
                  $document = '';
                }
                else if($docEnt != ''){
                  $document = "<a class='btn btn-danger btn-sm' href='../logica/descarga.php?archivos= echo".$guiaEntra->Documento($numero)."'>Descargar</a>";
                }
              }
              ?>
              <div class="row pt-3">
                <div class="col-5">
                  <div class="mx-auto"> <h2>Detalle</h2></div>
                </div>
                <div class="col-7">
                  <div class="btn-group  " role="group" aria-label="Basic example">
                    <a href="ModificarGuia.php?codigo=<?php echo $folio?>" class="btn btn-outline-danger float-left " role="button" ><span class="icon-suitcase"></span>Modificar</a>
                    <a class="btn btn-outline-danger float-left disabled" data-bs-toggle="modal" data-bs-target="#modalFormEgreso" aria-disabled="true"><span class="icon-suitcase"></span>Ingresar Guia</a>
                    <a class="btn btn-outline-danger float-left"  onclick="imprimirSeccion()"><span class="icon-suitcase"></span>Imprimir</a>
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
                if($docEnt == ''){
                  $document = '';
                }
                else if($docEnt != ''){
                  $document = "<a class='btn btn-danger btn-sm' href='../logica/descarga.php?archivos= echo".$guiaEntra->Documento($numero)."'>Descargar</a>";
                }
              }
              ?>
              <div class="row pt-3">
                <div class="col-5">
                  <div class="mx-auto"> <h1>Detalle </h1></div>
                </div>
                <div class="col-7">
                  <div class="btn-group  " role="group" aria-label="Basic example">
                    <a href="ModificarGuia.php?codigo=<?php echo $folio?>" class="btn btn-outline-danger float-left" role="button"><span class="icon-suitcase"></span>Modificar</a>
                    <a class="btn btn-outline-danger float-left" data-bs-toggle="modal" data-bs-target="#modalFormEgreso"><span class="icon-suitcase"></span>Ingresar Guia</a>
                    <a class="btn btn-outline-danger float-left"  onclick=" imprimirSeccion()"><span class="icon-suitcase"></span>Imprimir</a>
                  </div>
                </div>
              </div>
              <?php
            }
            ?>
            <div class="col-8">
                <div class="mx-auto"> <h2>Detalle Ingreso</h2> </div>
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
                  <div class="col"> <label class="fw-bold">Detalle</label></div>

                  <div class="col"> <label><?php echo $detalle ?> </label> </div>
                  <div class="col"> </div>
                </div>
                <div class="row">
                  <div class="col"> <label class="fw-bold">Guia de despacho</label> </div>
                  <div class="col"> <label><?php echo $docEnt;?></label></div>
                  <div class="col"> <label> <?php echo  $document; ?> </label></div>
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
            </div>
            <div class="col">
                <!--IMAGENES-->
                <?php
                  $imagenes= $guiaSali->MostrarImagen($folio);
                  foreach ($imagenes as  $i){
                  $direccion =  $i['imagen']; $id = $i['codimg']; $descipcion = $i['descripcion'];
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
    <!----------------------------------------------------------------------------------------------------------->
    <!--VENTADA MODAL DE CLIENTE-->
    <div class="modal fade" id="modalFormEgreso" tabindex="-1" aria-labelledby="FormModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ingresar cliente</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form class="form" role="form">
              <label class="col-form-label">Numero Guia</label>
              <input type="text" class="form-control" id="numeroGuia" name="numeroGuia" required/>
              <label class="col-form-label">Fecha</label>
              <input type="date" name=""  id="fecha2" class="form-control" value="<?php echo $fechaActual ?>">
              <div class="invalid-feedback" id="mistake"></div>
              <div class="valid-feedback" id="Right"></div>
            </form>
          </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="refresh('#modalFormCli')">Cancelar</button>
              <button type="button" class="btn  btn-danger" onclick="submitEgreso()">Guardar</button>
            </div>
          </div>
        </div>
      </div>
     <template id = "imp">
       <div class="container">
         <div class="h2 p-2">Informe </div>
         <div class="h3 p-2">Detalle de ingreso</div>
         <style>.table,th,td{border-bottom: solid 0.5px gray ;}</style>
         <table id="table" class="table table-sm" style=' font-size: 12px;    margin: 45px;     width: 480px; text-align: left;    border-collapse: collapse;  "' >
           <tr>
             <th scope="col"><label class="fw-bold">SC</label></th>
             <td scope="col"><label><?php echo $folio;  ?></label></td>
           </tr>
           <tr>
             <th scope="row"><label class="fw-bold">N° Guia</label></th>
             <td scope="col"><label><?php echo $numero; ?></label></td>
           </tr>
           <tr>
             <th scope="row"><label class="fw-bold">Codigo Solped</label></th>
             <td scope="col"><label style="text-transform:uppercase"><?php echo $codigo; ?></td>
           </tr>
           <tr>
             <th scope="row"><label class="fw-bold">Encargado Ingreso</label></th>
             <td scope="col"><label><?php echo $nombreen.' '.$apellido; ?></label></td>
           </tr>
           <tr>
             <th scope="row"><label class="fw-bold">Fecha Ingreso</label></th>
             <td scope="col"><label><?php echo $fecha;  ?></label></td>
           </tr>
           <tr>
             <th scope="row"><label class="fw-bold">Tipo Solicitud</label> </th>
             <td scope="col"><label><?php echo $solicitud; ?></label></td>
           </tr>
           <tr>
             <th scope="row"><label class="fw-bold">Cliente</label></th>
             <td scope="col"><label><?php echo $cliente;?></label></td>
           </tr>
           <tr>
             <th scope="row">  <label class="fw-bold">Estado</label> </th>
             <td scope="col"><label><?php echo $estado;?></label></label></td>
           </tr>
           <tr>
             <th scope="row"><label class="fw-bold">Detalle</label> </th>
             <td scope="col"><label><?php echo $detalle ?> </label></td>
           </tr>
         </table>
           <?php
           if($guiaSali->Existe($x)){
             ?><div class="">
                <table id="table" class="table table-sm" style=' font-size: 12px;    margin: 45px;     width: 480px; text-align: left;    border-collapse: collapse; "' >
                  <div class="h2">Detalle de Egreso</div>
                  <tr>
                    <th scope="row"><label class="fw-bold">N° de guia</label></th>
                    <td scope="col"><label><?php echo $numS; ?></label></td>
                  </tr>
                  <tr>
                  <th scope="row"><label class="fw-bold">Fecha de Egreso</label></th>
                  <td scope="col"><label ><?php echo $nfecha; ?></label></td>
                </tr>
              </table>
            </div>
          <?php
          }
          else {
            ?> <tr>
                <th scope="row" colspan="2"><label class="fw-bold">No se han encontrado datos de egreso</label></th>
                <th></th>
              </tr><br><?php
            }
            try {
              $db = Conectar::conexion();
              $consulta=$db->query('SELECT * FROM imgot WHERE codfolio ='.$folio);
              echo '<br><br><br><br><br><br><br><br><h3>Imagenes</h3>';
              echo "<table>";
              while ($row = $consulta->fetch_assoc()) {
                echo "<tr>";
                echo "<td style='width: 300px; height: 250px;'><img class='d-block w-20' src='".$row['imagen']."' alt='".$row['descripcion']." style='width: 100px; height: 100px;'></td>";
                echo "<td style='width: 300px; height: 250px;'><p>".$row['descripcion']."</p></td>";
                echo "</tr>";
              }
              echo "</table>";
            }catch (Exception $e) {
              echo 'Error al mostrar la imagen';
            }
            ?>
        </div>
      </template>
<script src="../bootstrap-5.0.0-beta2-dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script >
  function imprimirSeccion(){
     var mywindow = window.open('', 'PRINT', 'height=700,width=800');
    mywindow.document.write('<html><head>');
    mywindow.document.write('<link rel="stylesheet" href="../bootstrap-5.0.0-beta2-dist/css/bootstrap.min.css">');
    mywindow.document.write('<link rel="stylesheet" href="../css/StyleDetalle.css" type="text/css">');
    mywindow.document.write('</head><body >');
    mywindow.document.write(document.getElementById('imp').innerHTML);
    mywindow.document.write('</body></html>');
    mywindow.document.close(); // necesario para IE >= 10
    mywindow.focus();
    mywindow.print();
    mywindow.close();
    return true;
  }

  function submitEgreso(){
    var formData = new FormData();
         formData.append("numero", $("#numeroGuia").val());
         formData.append("fecha2", $("#fecha2").val());
         formData.append("folio", "<?php echo  $x?>");
         var numero =  $("#numeroGuia").val();
         var fecha  =  $("#fecha2").val();
         var folio  =  "<?php echo  $x?>";
         if(numero == ''){
           $("#mistake").html('Error al ingresar los datos').fadeIn();
         }
         else if(fecha == ''){
           $("#mistake").html('Error al ingresar los datos').fadeIn();
         }
         else{
           $.ajax({
             url: "../logica/InsertGuia.php",
             type: "POST",
             data: formData,
             contentType: false,
             cache: false,
             processData:false,
             beforeSend : function()
             {
                 $("#mistake").fadeOut();
             },
             success: function(data){
               if(data == 'error' ){
                 $("#mistake").html('Error al ingresar los datos').fadeIn();
                 //alert('Error a al ingresar los datos');
               }
               else if(data == 'vacio'){
                 $("#mistake").html('Error al ingresar los datos').fadeIn();
               }
               else{alert(data);}
             } ,
           });
         }
  }
  $('#myCarousel').on('slid.bs.carousel', function () {

    alert('hola');
  })

</script>
  </body>
</html>
