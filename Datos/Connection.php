<?php
class Conectar{
    public static function conexion(){
      try {
        $conexion=new mysqli("localhost", "root", "", "fmin3");
        $conexion->query("SET NAMES 'utf8'");
        return $conexion;
      } catch (PDOException $e) {
        echo 'Error '.$e;
      }
    }
}
?>
