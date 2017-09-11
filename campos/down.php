<?php
  require_once('functions.php');


  if (isset($_GET['camada'])){
    down_ordem_campos($_GET['camada'], $_GET['ordem'], $_GET['campo']);
    $url = 'location: index.php?mps03_cd_camada=' . $_GET['camada'];
    header($url);
  } else {
    die("ERRO: ID não definido.");
  }


?>
