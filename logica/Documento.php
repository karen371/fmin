<?php
class Documento
{

  private $nombre_final;
  private $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt','txt', 'docx'); // valid extensions

  function __construct()
  {

  }

  function AgregarArchivo(){


  }

  function ValidarArchivo($ext){
      if(in_array($ext, $this->valid_extensions)){
        return true;
      }
      else {
        return false;
      }
  }

  function EliminarArchivo($documento){
       unlink($documento);
  }

  function SubirArchivo($docu, $guia){
  }

}

 ?>
