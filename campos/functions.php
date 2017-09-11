<?php
require_once('../config.php');
require_once(DBAPI);

$campos = null;
$campo = null;

/**
 *  Listagem de Campos
 */

function index() {
	global $campos;
	$campos = findOrd( 'mapsrv.mps06_campos', $_GET['mps03_cd_camada'], 'mps06_cd_camada', 'mps06_cd_ordem' );
}

function add() {
	if (!empty($_POST['campo'])) {
		//print_r($_POST['camprj']);
    save('mapsrv.mps06_campos', $_POST['campo']);
    $url = 'location: index.php?mps03_cd_camada=' . $_GET['mps03_cd_camada'];
	  header($url);
  }

}

/**
 *  Exclusão de um Campo
 */
function delete($id = null, $nm_ordem, $cd_camada) {
  global $customer;
	global $exQry;
  $exQry = delete_campos( $id, $nm_ordem, $cd_camada);
	//remove('mapsrv.mps06_campos', $id, 'mps06_id_campo');
  //header('location: index.php?mps03_cd_camada=' . $cd_camada);
}


?>
