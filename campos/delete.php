<?php
  require_once('functions.php');
  if (isset($_GET['id'])){
    delete($_GET['id'], $_GET['ord'], $_GET['cam']);
    $url = 'location: index.php?mps03_cd_camada=' . $_GET['cam'];
  //  echo($_GET['id'] . '-' . $_GET['ord'] . '-' . $_GET['cam']);
   header($url);
  } else {
    die("ERRO: ID não definido.");
  }
?>
