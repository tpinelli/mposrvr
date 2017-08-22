<?php
require_once('../config.php');
require_once(DBAPI);

$customers = null;
$customer = null;

/**
 *  Listagem de Projetos
 */

function index() {
	global $customers;
	$customers = find_all('mapsrv.mps02_clientes');
}

function add() {
  if (!empty($_POST['customer'])) {
    save('mapsrv.mps02_clientes', $_POST['customer']);
    header('location: index.php');
  }
}

function edit() {
  if (isset($_GET['mps02_cd_cli'])) {
    $id = $_GET['mps02_cd_cli'];
    if (isset($_POST['customer'])) {
      $customer = $_POST['customer'];
      update('mapsrv.mps02_clientes', $id, $customer, 'mps02_cd_cli');
      header('location: index.php');
    } else {
      global $customer;
      $customer = find('mapsrv.mps02_clientes', $id, 'mps02_cd_cli');
    }
  } else {
    header('location: index.php');
  }
}

/**
 *  Exclusão de um Projeto
 */
function delete($id = null) {
  global $customer;
  $customer = remove('mapsrv.mps02_clientes', $id, 'mps02_cd_cli');
  header('location: index.php');
}

?>
