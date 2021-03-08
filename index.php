<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/StyleLogin.css" type="text/css">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <title>Login</title>
  </head>
  <body>
    <div class="page">
      <div class="container">
        <div class="left">
            <div class="login"><h4>Bienvenido</h4></div>
        </div>
        <div class="right">
          <svg viewBox="0 0 320 300">
              <defs>
                <linearGradient
                                inkscape:collect="always"
                                id="linearGradient"
                                x1="13"
                                y1="193.49992"
                                x2="307"
                                y2="193.49992"
                                gradientUnits="userSpaceOnUse">
                  <stop
                        style="stop-color:#b30000;"
                        offset="0"
                        id="stop876" />
                  <stop
                        style="stop-color:#e70000;"
                        offset="1"
                        id="stop878" />
                </linearGradient>
              </defs>
              <path d="m 40,120.00016 239.99984,-3.2e-4 c 0,0 24.99263,0.79932 25.00016,35.00016 0.008,34.20084 -25.00016,35 -25.00016,35 h -239.99984 c 0,-0.0205 -25,4.01348 -25,38.5 0,34.48652 25,38.5 25,38.5 h 215 c 0,0 20,-0.99604 20,-25 0,-24.00396 -20,-25 -20,-25 h -190 c 0,0 -20,1.71033 -20,25 0,24.00396 20,25 20,25 h 168.57143" />
          </svg>
          <div  class="form" >
            <form id="ingresar" >
              <label for="Usuario"></label>
              <input id="user" name="user"  type="text"  placeholder="Ingrese su usuario" required>
              <label for="Contraseña"></label>
              <input id="pass" name="pass"  type="password" placeholder="Contraseña" required>
              <input type="submit" id="submit" value="Iniciar Sesión">
            </form>
          </div>
        </div>
      </div>
    </div>
   <!-- jQuery -->
   <script src="resources/jquery.min.js"></script>
   <!-- Bootstrap 4 -->
   <script src="resources/bootstrap.bundle.min.js"></script>
   <!-- AdminLTE App -->
   <script src="resources/adminlte.min.js"></script>
   <script>
     $("#ingresar").submit(function(e){
         var usuario = $("#user").val();
         var password = $("#pass").val();
         $.ajax({
             url : "logica/autentificacion.php",
             type : "POST",
             data : "&user="+usuario+"&pass="+password,
             datatype : "json",
             success: function(data){
                 switch(data.codigo)
                 {
                     case 1:
                     //alert(data.mensaje);
                     location.href ="Vistas/Inicio.php";
                     break;
                     case 2:
                        alert(data.mensaje);
                        limpiar();
                     break;
                 }
             }
         });
         e.preventDefault();
     });
     function limpiar()
     {
       $("#user").val('');
       $("#pass").val('');
     }
   </script>
     </body>
  </html>
