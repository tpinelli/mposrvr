<?php
require_once('../config.php');
require_once(DBAPI);

$camprjs = null;
$camprj = null;
$dsAgrpd = null;
$agrpds = null;
$agrpd = null;

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

function addAgrpd() {
	if (!empty($_POST['agrpdSel'])) {
    $sel = $_POST['agrpdSel'];
		$vlr = current($sel);
	
		if($vlr == 'NULL') {
		  update_null('mapsrv.mps04_prj_cam', $_GET['mps01_cd_prj'], 'mps04_cd_agrpd', 'mps01_cd_prj', $_GET['cdAgrpd'], 'mps03_cd_camada');
		} else {
		  update('mapsrv.mps04_prj_cam', $_GET['mps01_cd_prj'], $sel, 'mps01_cd_prj', $_GET['cdAgrpd'], 'mps03_cd_camada');
		}
    $url = 'location: index.php?mps01_cd_prj=' . $_GET['mps01_cd_prj'];
	  header($url);
  } else {
		global $agrpds;
		$agrpds = find_all('mapsrv.mps05_agrpd');
  }

}

function listAgrpd($id = null){
	global $dsAgrpd;
	if(!is_null($id)) {
    $agrpd = find( 'mapsrv.mps05_agrpd', $id, 'mps05_cd_agrpd');
	  return $agrpd['mps05_lg_agrpd'];
	}
}


?>
