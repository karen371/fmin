<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
      <meta charset="UTF-8">
    	<title></title>
    	      <link rel="stylesheet" href="../css/StyleMenu.css">
      <link rel="stylesheet" href="../css/StyleTablas.css">
    </head>
<body>
	 <head class="head">
      <?php include('menu.php'); ?>
   </head>
  <body> <!--SOLO MUESTRA LOS 15 ULTIMOS INGRESOS-->
      <div class="Separacion"></div>
      <?php include('Tabla.php'); ?>
  </body>
</body>
</html>
