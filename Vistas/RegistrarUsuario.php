<?php
require_once("../Datos/Connection.php");
require_once("../Controller/ControladorCargo.php");

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
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
  </head>
  <body>
    <div class="container">
      <div class="col-12"></div>
      <div class="col-3"></div>
      <div class="col-9">
        <p class="text-center my-4 display-5">Registro de Usuario</p>
        <div action="../logica/registrarguia.php" enctype="multipart/form-data" class="form">
        <div class="row mb-3">
          <label for="rut" class="col-sm-3 col-form-label">Rut</label>
           <div class="col-sm-9">
             <input  class="form-control" type="text" id="rut" name="rut" required>
           </div>
        </div>
        <div class="row mb-3">
          <label for="nombre" class="col-sm-3 col-form-label">Nombre</label>
          <div class="col-sm-9">
            <input  class="form-control" type="text" id="nombre" name="nombre" required>
          </div>
        </div>
        <div class="row mb-3">
          <label for="apellido" class="col-sm-3 col-form-label">Apellido</label>
          <div class="col-sm-9">
            <input  class="form-control" type="text" id="apellido" name="apellido" required>
          </div>
        </div>
        <div class="row mb-3">
          <label for="contrasena" class="col-sm-3 col-form-label">Contraseña</label>
          <div class="col-sm-9">
            <input  class="form-control" type="password" id="contrasena" name="contrasena" required>
          </div>
        </div>
        <div class="row mb-3">
          <label for="usuario" class="col-sm-3 col-form-label">Usuario</label>
          <div class="col-sm-9">
            <input  class="form-control" type="text" id="usuario" name="usuario" required>
          </div>
        </div>
        <!--SOLICITUD-->
        <div class="row mb-3">
          <label for="solicitud" class="col-sm-3 col-form-label">Tipo de usuario</label>
          <div class="col-sm-8">
            <select class="form-select" id="cargo" name="cargo">
              <option value='inicio'>Seleccione una Opcion</option>
              <?php foreach ($datos as $key => $c) {?>
                <option value="<?php echo $c['cod']  ?>"><?php echo $c['nombre'] ?></option><?php }?>
            </select>
            <div class="invalid-feedback" id="mistake2"></div>
          </div>
        </div>
        <div class="row mb-3">
          <label for="doc" class="col-sm-3 col-form-label"></label>
          <div class="d-grid gap-2 col-6 mx-auto">
            <button class="btn btn-danger btn-lg btn-block" type="button"  id="ingresar">Registrar</button>
          </div>
        </div>
      </div>
     </div>
    </div>
    <!--SCRIPT-->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../bootstrap-5.0.0-beta2-dist/js/bootstrap.min.js"></script>
    <script>
    $("#ingresar").on('click',(function(e) {
     var formData = new FormData();
         formData.append("rut", $("#rut").val());
         formData.append("nombre", $("#nombre").val());
         formData.append("apellido", $("#apellido").val());
         formData.append("usuario", $("#usuario").val());
         formData.append("contrasena", $("#contrasena").val());
         formData.append("cargo", $("#cargo").val());

         $.ajax({
           url: "../logica/registrarusuario.php",
           type: "POST",
           data: formData,
           contentType: false,
           cache: false,
           processData:false,
           success: function(data){
             if(data == 'error'){
               alert('campos vacios');
             }
             else{ alert(data)}
           }
         });
     e.preventDefault();
    }));
    </script>
  </body>
</html>
