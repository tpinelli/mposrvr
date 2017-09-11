<?php
require_once('../config.php');
require_once(DBAPI);

$projects = null;
$project = null;

/**
 *  Listagem de Projetos
 */

function index() {
	global $projects;
	$projects = find_all('mapsrv.mps01_projetos');
}

function add() {
  if (!empty($_POST['project'])) {
    save('mapsrv.mps01_projetos', $_POST['project']);
    header('location: index.php');
  }
}

function edit() {
  if (isset($_GET['mps01_cd_prj'])) {
    $id = $_GET['mps01_cd_prj'];
    if (isset($_POST['project'])) {
      $project = $_POST['project'];
      update('mapsrv.mps01_projetos', $id, $project);
      header('location: index.php');
    } else {
      global $project;
      $project = find('mapsrv.mps01_projetos', $id, 'mps01_cd_prj');
    }
  } else {
    header('location: index.php');
  }
}

/**
 *  Exclusão de um Projeto
 */
function delete($id = null) {
  global $project;
  $project = remove('mapsrv.mps01_projetos', $id, 'mps01_cd_prj');
  header('location: index.php');
}

function listAgrpd($id = null){
	global $agrpd;
	global $dsAgrpd;
	if(!is_null($id)) {
    $agrpdores = find( 'mapsrv.mps05_agrpd', $id, 'mps05_cd_agrpd');
		foreach ($agrpdores as $agrpd) :
			$dsAgrpd = $agrpd['mps05_lg_agrpd'];
		endforeach;

		return $dsAgrpd;
		}
}



?>
