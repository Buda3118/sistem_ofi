<?php

require_once '../models/Clasificacion.php';

  if(isset($_POST['operacion'])){
    $clasificacion = new Clasificacion();

    if($_POST['operacion'] == 'listarClasificaciones'){
      $dataClasificacion = $clasificacion->listarClasificaciones();
      echo json_encode($dataClasificacion);
    }
  }

?>