<?php
session_start();
require_once '../models/Producto.php';

$producto = new Producto();

  if(isset($_POST['operacion'])){
    if($_POST['operacion'] == 'listarProductos'){
      echo json_encode($producto->listarProductos());
    }

    if($_POST['operacion'] == 'registrarProductos'){
      $datosGuardar = [
        "idclasificacion"   => $_POST['idclasificacion'],
        "idmarca"           => $_POST['idmarca'],
        "descripcion"       => $_POST['descripcion'],
        "numeroserie"       => $_POST['numeroserie'],
        "cantidad"          => $_POST['cantidad']
      ];
  
      //$producto->registrarProductos($datosGuardar);
      echo json_encode($producto->registrarProductos($datosGuardar));
    }

    if ($_POST['operacion'] == 'eliminarProducto') {
      $respuesta = $producto->eliminarProducto($_POST['idproducto']);
      echo json_encode($respuesta);
    }

    if ($_POST['operacion'] == 'obtenerProducto') {
      $respuesta = $producto->obtenerProducto($_POST['idproducto']);
      echo json_encode($respuesta);
    }

    if ($_POST['operacion'] == 'actualizarProducto') {
      $datosActualizar = [
        "idclasificacion" => $_POST['idclasificacion'],
        "idmarca" => $_POST['idmarca'],
        "descripcion" => $_POST['descripcion'],
        "numeroserie" => $_POST['numeroserie'],
        "cantidad" => $_POST['cantidad']
      ];

      $respuesta = $producto->actualizarProducto($datosActualizar);
      echo json_encode($respuesta);
  }
  
}
?>