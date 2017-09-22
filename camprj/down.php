<?php
  require_once('functions.php');


  if (isset($_GET['proj'])){
    down_ordem($_GET['proj'], $_GET['ordem'], $_GET['camada']);
    $url = 'location: index.php?mps01_cd_prj=' . $_GET['proj'];
    header($url);
  } else {
    die("ERRO: ID não definido.");
  }


?>
