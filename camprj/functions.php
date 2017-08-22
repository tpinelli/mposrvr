<?php
require_once('../config.php');
require_once(DBAPI);

$camprjs = null;
$camprj = null;

/**
 *  Listagem de Projetos
 */

function index() {
	global $camprjs;
	$camprjs = find_cam_prj( $_GET['mps01_cd_prj']);
}

function add() {
	if (!empty($_POST['camprj'])) {
		//print_r($_POST['camprj']);
    save('mapsrv.mps04_prj_cam', $_POST['camprj']);
    $url = 'location: index.php?mps01_cd_prj=' . $_GET['mps01_cd_prj'];
	  header($url);
  } else {
		global $camadas;
		$camadas = find_all('mapsrv.mps03_camadas');
  }

}


?>
