<?php

require_once '../models/Marca.php';

  if(isset($_POST['operacion'])){
    $marca = new Marca();

    if($_POST['operacion'] == 'listarMarcas'){
      $dataMarcas = $marca->listarMarcas();
      echo json_encode($dataMarcas);
    }
  }

?>