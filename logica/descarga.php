<?php
//Si la variable archivo que pasamos por URL no esta
//establecida acabamos la ejecucion del script.


  if (!isset($_GET['archivos']) || empty($_GET['archivos'])) {
     exit();
  }

  //Utilizamos basename por seguridad, devuelve el
  //nombre del archivo eliminando cualquier ruta.
  $archivo = basename($_GET['archivos']);

  $ruta = '../Archivos/'.$archivo;

  if (is_file($ruta))
  {
     header('Content-Type: application/force-download');
     header('Content-Disposition: attachment; filename='.$archivo);
     header('Content-Transfer-Encoding: binary');
     header('Content-Length: '.filesize($ruta));

     readfile($ruta);
  }
  else
     exit();
?>
