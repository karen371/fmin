<?php
session_start();
$fechaActual = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../bootstrap-5.0.0-beta2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="../css/Stylemenu.css" type="text/css">
  </head>
  <body>
    <?php include('menu.php');
    $codigo = $_GET['codigo'];
  //  echo $codigo;
    ?>
  <div class="container d-flex justify-content-center pt-5">
     <div class="col-9 ">
          <div class="col-8 ">
            <h2 class="my-2 display-7">Ingresar Guia despacho Egreso</h2>
          </div>
      <form class="form" id="ingresar" enctype="multipart/form-data" action="../logica/InsertGuia.php">
        <div class="row mb-4">
          <label  for="numero" class="col-sm-3 col-form-label">N° Guia</label>
          <div class="col-sm-8">
              <input class="form-control" type="text"  value="" id="numero" name="numero">
              <div class="invalid-feedback" id="mistake"></div>
          </div>
        </div>
        <div class="row mb-4">
          <label class="col-sm-3 col-form-label" for="Fecha">Fecha</label>
          <div class="col-sm-8">
            <input class="form-control" type="date"  value="<?php echo $fechaActual ?>" id="fecha" name="fecha">
            <div class="invalid-feedback" id="mistake2"></div>
          </div>
        </div>
        <div class="row mb-4">
          <label class="col-sm-3 col-form-label" for="documento">Documento</label>
          <div class="col sm-8">
            <input class="form-control" type="file" name="" value="" id="doc" name="doc">
            <div class="invalid-feedback" id="mistake3"></div>
          </div>
        </div>
        <div class="row">
          <div class="invalid-feedback" id="mistake4"></div>
          <div class="d-grid gab-3">
            <button class="btn btn-danger btn-lg btn-block" type="submit" >Registrar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../bootstrap-5.0.0-beta2-dist/js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function (e){
      $("#ingresar").on('submit',(function(e){
       var formData = new FormData();
            formData.append("numero", $("#numero").val());
            formData.append("fecha", $("#fecha").val());
            formData.append("folio", "<?php echo $codigo ?>");
            var file_data = $("#doc")[0].files;
             for (var i = 0; i < file_data.length; i++){
               formData.append("doc", file_data[i]);
             }
             $.ajax({
              url: "../logica/InsertGuia.php",
              type: "POST",
              data: formData,
              dataType: 'json',
              contentType: false,
              cache: false,
              processData:false,
              beforeSend : function()
              {
                  $("#mistake").fadeOut();
                  $("#mistake2").fadeOut();
              },
              success: function(data)
              {
              if(data.mensaje == "vacio")
                {
                //  alert("*Campos obligatorios");
                  $("#mistake").html("*Campos obligatorios").fadeIn(); // formato de archivo invalido
                }
                else if(data.mensaje == "error"){
                  $("#mistake").html("Error al ingresar los datos").fadeIn();
                //  alert("Error al ingresar los datos");
                }
                else if(data.mensaje == "falla"){
                  $("#mistake").html("*Campos obligatorios").fadeIn();
                //  alert("Error al ingresar los datos");
                }
                else
                {
                  alert(data.mensaje);
                  location.href ="Inicio.php";
                  /*Enviar a la pagina de detalle*/
                }
              },
            });
            e.preventDefault();
      }));
    });
  </script>

  </body>
</html>
