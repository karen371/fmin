<?php


/**
 *
 */
class
{

  require_once("../Modelo/GuiaSalida.php");

  private $clase = new  GuiaSalida();

  function __construct() {

  }

  public function($fecha ,  $num){
    return  InsertGuia($fecha , $num);
  }
}


 ?>
