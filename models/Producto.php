<?php

require_once "Conexion.php";

  class Producto extends Conexion{
    private $acceso;

    public function __construct(){
      $this->acceso = parent::getConexion();
    }

    //LOS MÉTODOS SON VERBOS
    public function listarProductos(){
      try {
        $consulta = $this->acceso->prepare("CALL spu_productos_listar()");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
      } 
      catch (Exception $e) {
        die($e->getMessage());
      }
    }

    public function registrarProductos($datosGuardar){
      $respuesta = [
        "status" => false,
        "message" => ""
      ];
      
      try{
        $consulta = $this->acceso->prepare("CALL spu_productos_registrar(?,?,?,?,?)");
        $respuesta["status"] = $consulta->execute(array(
          $datosGuardar['idclasificacion'],
          $datosGuardar['idmarca'],
          $datosGuardar['descripcion'],
          $datosGuardar['numeroserie'],
          $datosGuardar['cantidad']
        ));
      }
      catch(Exception $e){
        $respuesta["message"] = "No se ha podido completar el proceso. Código de error: " . $e->getCode();
        // die($e->getMessage());
      }
      return $respuesta;
    }
    public function eliminarProducto($idproducto = 0){
      $respuesta = [
        "status" => false,
        "message" => ""
      ];
  
      try{
        $consulta = $this->acceso->prepare("CALL spu_productos_eliminar(?)");
        $respuesta["status"] = $consulta->execute(array($idproducto));
      }catch(Exception $e){
        $respuesta["message"] = "No se ha podido completar el proceso. Código de error: " . $e->getCode();
      }
  
      return $respuesta;
    }

    public function obtenerProducto($idproducto = 0){
      try{
        $consulta = $this->acceso->prepare("CALL spu_productos_obtener(?)");
        $consulta->execute(array($idproducto));
        return $consulta->fetch(PDO::FETCH_ASSOC);
      }catch(Exception $e){
        die($e->getMessage());
      }
    }

    public function actualizarProducto($datos = []){
      $respuesta = [
        "status" => false,
        "message" => ""
      ];
  
      try{
        $consulta = $this->acceso->prepare("CALL spu_productos_actualizar(?,?,?,?,?)");
        $respuesta["status"] = $consulta->execute(array(
          $datos["idclasificacion"],
          $datos["idmarca"],
          $datos["descripcion"],
          $datos["numeroserie"],
          $datos["cantidad"]
        ));
      }catch(Exception $e){
        $respuesta["message"] = "No se ha podido completar el proceso. Código de error: " . $e->getCode();
      }
  
      return $respuesta;
    }

    }
    ?>