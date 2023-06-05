<?php

require_once 'Conexion.php';

class Trabajador extends Conexion{

  private $conexion;

  public function __CONSTRUCT(){
    $this->conexion = parent::getConexion();
  }

  public function login($email){
    try{
      $consulta = $this->conexion->prepare("CALL spu_trabajadores_login(?)");
      $consulta->execute(array($email));

      return $consulta->fetch(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

}