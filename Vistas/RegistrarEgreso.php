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
     <link rel="stylesheet" href="../css/Stylemenu.css" type="text/css">
  </head>
  <body>
    <?php include('menu.php');
    $codigo = $_GET['codigo'];
    ?>
    <div class="container h-100">
        <div class="col-9 mx-auto pt-5">
          <div class="col-8">
            <h2 class="my-2 display-7">Ingresar Guia despacho Egreso</h2>
          </div>
      <form action="../logica/InsertGuia.php" enctype="multipart/form-data" class="form">
            <div class="row mb-4">
              <label for="folio" class="col-sm-3 col-form-label">Numero Guia</label>
              <div class="col-sm-8">
                <input  class="form-control" type="text" id="numero" name="numero">
                <div class="invalid-feedback" id="mistake"></div>
              </div>
            </div>
            <div class="row mb-4">
               <label for="encargado" class="col-sm-3 col-form-label">Fecha de Envio</label>
               <div class="col-sm-8">
                   <input class="form-control" type="date" id=fecha name= "doc" value = "<?php echo $fechaActual ?>">
                   <div class="invalid-feedback" id="mistake2"></div>
               </div>
            </div>
            <div class="row mb-4">
               <label for="numero" class="col-sm-3 col-form-label">Documento</label>
               <div class="col-sm-8">
                    <input id="doc" class="form-control" type="file" accept=".doc,.docx,.pdf,.txt" name="doc" />
                     <div class="invalid-feedback" id="mistake3"></div>
               </div>
            </div>
            <div class="row">
              <div class="row">
                <div class="d-grid gap-3" >
                    <button class="btn btn-danger btn-lg btn-block" type="submit">Registrar</button>
                </div>
              </div>
          </div>
        </form>
      </div>
  </div>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
    $("#ingresar").on('click',(function(e) {
     var formData = new FormData();
         formData.append("numero", $("#numero").val());
         formData.append("fecha", $("#fecha").val());
         formData.append("folio", "<?php echo $codigo ?>");
         var file_data = $("#doc")[0].files;
          for (var i = 0; i < file_data.length; i++) {
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
         if(data.mensaje == 'vacio')
         {
            $("#mistake").html("*Campos obligatorios").fadeIn(); // formato de archivo invalido
         }
         else
         {
           alert(data.mensaje);
         }
       },
     });
     e.preventDefault();
   }));
    </script>
    <script src="../bootstrap-5.0.0-beta2-dist/js/bootstrap.min.js"></script>
  </body>
</html>
