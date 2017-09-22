<?php
  require_once('functions.php');
  if (isset($_GET['id'])){
    delete_camprj($_GET['id'], $_GET['ord']);
    $url = 'location: index.php?mps01_cd_prj=' . $_GET['id'];
    header($url);
  } else {
    die("ERRO: ID não definido.");
  }
?>
