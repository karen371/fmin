<?php

/**
 *
 */
class Documento
{

  private $nombre_final;


  function __construct( )
  {

  }

  function ValidarArchivo($ext, $valid_extensions){
      if(in_array($ext, $valid_extensions)){
        return true;
      }
      else {
        return false;
      }
  }

  function EliminarArchivo($documento){
       unlink($documento);
  }

  function SubirArchivo($tmp, $path){
      if(move_uploaded_file($tmp, $path)){
       return true;
      }
      else{
        return false;
      }
  }

}

 ?>
