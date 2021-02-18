<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
      <meta charset="UTF-8">
    	<title>Inicio</title>
      <link rel="stylesheet" href="../css/Stylemenu.css">
    	<!--<link rel="stylesheet" href="../css/StyleTablas.css">-->
      <link rel="stylesheet"  href="../bootstrap-5.0.0-beta2-dist/CSS/bootstrap.min.css">
    </head>
<body>
	 <head class="head">
      <?php include('menu.php'); ?>
   </head>
  <body> <!--SOLO MUESTRA LOS 15 ULTIMOS INGRESOS-->
      <div class="Separacion"></div>
      <?php include('Tabla.php'); ?>
  </body>
  <script src="../bootstrap-5.0.0-beta2-dist/js/bootstrap.min.js"></script>
</body>
</html>
