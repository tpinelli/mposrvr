<?php
require_once('../config.php');
require_once(DBAPI);

$agrpds = null;
$agrpd = null;

/**
 *  Listagem de Projetos
 */

function index() {
	global $agrpds;
	$agrpds = find_all('mapsrv.mps05_agrpd');
}

function add() {
  if (!empty($_POST['agrpd'])) {
    save('mapsrv.mps05_agrpd', $_POST['agrpd']);
    header('location: index.php');
  }
}

function edit() {
  if (isset($_GET['mps05_cd_agrpd'])) {
    $id = $_GET['mps05_cd_agrpd'];
    if (isset($_POST['agrpd'])) {
      $camada = $_POST['agrpd'];
      update('mapsrv.mps05_agrpd', $id, $agrpd, 'mps05_cd_agrpd');
      header('location: index.php');
    } else {
      global $agrpds;
			global $agrpd;
      $agrpds = find('mapsrv.mps05_agrpd', $id, 'mps05_cd_agrpd');
			$agrpd = $agrpds[0];
    }
  } else {
    header('location: index.php');
  }
}

/**
 *  Exclusão de um Projeto
 */
function delete($id = null) {
  global $agrpd;
  $agrpd = remove('mapsrv.mps05_agrpd', $id, 'mps05_cd_agrpd');
  header('location: index.php');
}

?>
