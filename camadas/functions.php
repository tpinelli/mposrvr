<?php
require_once('../config.php');
require_once(DBAPI);

$camadas = null;
$camada = null;

/**
 *  Listagem de Projetos
 */

function index() {
	global $camadas;
	$camadas = find_all('mapsrv.mps03_camadas');
}

function add() {
  if (!empty($_POST['camada'])) {
    save('mapsrv.mps03_camadas', $_POST['camada']);
    header('location: index.php');
  }
}

function edit() {
  if (isset($_GET['mps03_cd_camada'])) {
    $id = $_GET['mps03_cd_camada'];
    if (isset($_POST['camada'])) {
      $camada = $_POST['camada'];
      update('mapsrv.mps03_camadas', $id, $camada, 'mps03_cd_camada');
      header('location: index.php');
    } else {
      global $camada;
			$camadas = null;
      $camadas = find('mapsrv.mps03_camadas', $id, 'mps03_cd_camada');
			$camada = $camadas[0];
    }
  } else {
    header('location: index.php');
  }
}

/**
 *  Exclusão de um Projeto
 */
function delete($id = null) {
  global $camada;
  $camada = remove('mapsrv.mps03_camadas', $id, 'mps03_cd_camada');
  header('location: index.php');
}

?>
