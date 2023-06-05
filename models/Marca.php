<?php

require_once "Conexion.php";

  class Marca extends Conexion{
    private $acceso;

    public function __construct(){
      $this->acceso = parent::getConexion();
    }

    public function listarMarcas(){
      try {
        $consulta = $this->acceso->prepare("CALL spu_marcas_listar()");
        $consulta->execute();
        
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
      } 
      catch (Exception $e) {
        die($e->getMessage());
      }
    }
  }
  
?>