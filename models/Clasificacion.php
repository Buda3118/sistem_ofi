<?php

require_once "Conexion.php";

class Clasificacion extends Conexion{
  private $acceso;

  public function __construct(){
    $this->acceso = parent::getConexion();
  }

  public function listarClasificaciones(){
    try {
      $consulta = $this->acceso->prepare("CALL spu_clasificaciones_listar()");
      $consulta->execute();

      return $consulta->fetchAll(PDO::FETCH_ASSOC);;
    } 
    catch (Exception $e) {
      die($e->getMessage());
    }
  }
}
  
?>