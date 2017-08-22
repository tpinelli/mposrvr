<?php


// ====>> FUNÇÕES DE ABERTURA E FECHAMENTO DA BASE DE DADOS

function open_database() {
	try {
    $conn = pg_connect (DB_STRING);
		return $conn;
	} catch (Exception $e) {
		echo $e->getMessage();
		return null;
	}
}

function close_database($conn) {
	try {
		pg_close($conn);
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}

// ====>> FUNÇÕES DE PESQUISA EM TABELA

/**
 *  Pesquisa um Registro pelo ID em uma Tabela
 */
function find( $table = null, $id = null, $chave = null, $id2 = null, $chave2 = null ) {

	$database = open_database();
	$found = null;


	try {
	  if ($id) {
	    $sql = "SELECT * FROM " . $table . " WHERE " . $chave . "= '" . $id . "'";
			if ($id2): $sql .= " AND " . $chave2 . " = " . $id2; endif;
	    $result = pg_query($database, $sql);

	    if (pg_num_rows($result) > 0) {
				$found = pg_fetch_array($result);

	    } else {
				$_SESSION['message'] = 'Registro não encontrado.';
		    $_SESSION['type'] = 'danger';
			}

	  } else {

	    $sql = "SELECT * FROM " . $table;
	    $result = pg_query($database, $sql);

	    if (pg_num_rows($result) > 0) {
	      $found = pg_fetch_all($result);
	    }

	  }
	} catch (Exception $e) {
	  $_SESSION['message'] = $e->GetMessage();
	  $_SESSION['type'] = 'danger';
  }

	close_database($database);
	return $found;
}

/**
 *  Pesquisa Todos os Registros de uma Tabela
 */
function find_all( $table ) {
  return find($table);
}

/**
 *  Pesquisa a tabela PRJ_CAM, pelo código de projeto
 */

function find_cam_prj( $id = null) {

	$database = open_database();
	$found = null;


	try {
	    $sql = "select mps03_ur_camada, mps03_ly_camada, mps03_nm_camada, mps01_cd_prj, mps04_nm_ordem, mps03_ds_legenda, mps03_camadas.mps03_cd_camada, mps03_ds_camada
			  from mapsrv.mps03_camadas, mapsrv.mps04_prj_cam
			 where mapsrv.mps04_prj_cam.mps01_cd_prj = '" . $id . "'
			   and mapsrv.mps03_camadas.mps03_cd_camada = mapsrv.mps04_prj_cam.mps03_cd_camada
			 order by mapsrv.mps04_prj_cam.mps04_nm_ordem";
	    $result = pg_query($database, $sql);

	    if (pg_num_rows($result) > 0) {
				$found = pg_fetch_all($result);

	    } else {
				//$_SESSION['message'] = 'Registro não encontrado.';
		    //$_SESSION['type'] = 'danger';
			 }


	} catch (Exception $e) {
	  $_SESSION['message'] = $e->GetMessage();
	  $_SESSION['type'] = 'danger';
  }

	close_database($database);
	return $found;
}



// ====>> FUNÇÕES DE INSERT EM TABELA

/**
* Busca o próximo valor de uma chave
*/

function nextval($sequence) {
  $database = open_database();
	$found = null;

  $sql = "SELECT NEXTVAL('" .$sequence. "');";

	try {
		$result = pg_query($database, $sql);
    $found = pg_fetch_assoc($result);
    $_SESSION['message'] = 'Registro cadastrado com sucesso.';
    $_SESSION['type'] = 'success';

  } catch (Exception $e) {

    $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
    $_SESSION['type'] = 'danger';
  }
  close_database($database);
  return $found;

}


/**
*  Insere um registro no BD
*/
function save($table = null, $data = null) {
  $database = open_database();
  $columns = null;
  $values = null;

  //print_r($data);
  foreach ($data as $key => $value) {
    $columns .= trim($key, "'") . ",";
    $values .= "'$value',";
  }
  // remove a ultima virgula
  $columns = rtrim($columns, ',');
  $values = rtrim($values, ',');

  $sql = "INSERT INTO " . $table . "($columns)" . " VALUES " . "($values);";

  try {

    $result = pg_query($database, $sql);

		if($result) {
			$_SESSION['message'] = 'Registro atualizado com sucesso.';
	    $_SESSION['type'] = 'success';
		} else {
			$_SESSION['message'] = pg_last_error($database);
			$_SESSION['type'] = 'danger';
		}

  } catch (Exception $e) {

    $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
    $_SESSION['type'] = 'danger';

  }
  close_database($database);
}


// ====>> FUNÇÕES DE UPDATE EM TABELA

/**
 *  Atualiza um registro em uma tabela, por ID
 */
function update($table = null, $id = 0, $data = null, $chave = null) {
  $database = open_database();
  $items = null;

  foreach ($data as $key => $value) {
    $items .= trim($key, "'") . "='$value',";
  }

  // remove a ultima virgula
  $items = rtrim($items, ',');
  $sql  = "UPDATE " . $table;
  $sql .= " SET $items";

	if (is_string($id)) :
		               $sql .= " WHERE " . $chave . "= '" . $id . "';";
                 else :
									 $sql .= " WHERE " . $chave . "=" . $id . ";";
	endif;

  try {
    $result = pg_query($database, $sql);

		if($result) {
			$_SESSION['message'] = 'Registro atualizado com sucesso.';
	    $_SESSION['type'] = 'success';
		} else {
			$_SESSION['message'] = pg_last_error($database);
			$_SESSION['type'] = 'danger';
		}

  } catch (Exception $e) {
    $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
    $_SESSION['type'] = 'danger';
  }
  close_database($database);
}

/**
 *  troca a sobe a ordem de apresentação da camadas
 */

function up_ordem($cd_prj = null, $nm_ordem_ant = 0, $cd_camada = 0){
  $database = open_database();
  $nm_ordem_atu = $nm_ordem_ant - 1;

	$sql  = "UPDATE mapsrv.mps04_prj_cam ";
	$sql .= "SET mps04_nm_ordem = " . $nm_ordem_ant;
	$sql .= " WHERE mps01_cd_prj = '" . $cd_prj . "'";
	$sql .= "  AND mps04_nm_ordem =" . $nm_ordem_atu . ";";

  print 'SQL1='. $sql;

	try {
    $result = pg_query($database, $sql);
    $_SESSION['message'] = 'Registro atualizado com sucesso.';
    $_SESSION['type'] = 'success';
  } catch (Exception $e) {
    $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
    $_SESSION['type'] = 'danger';
  }


  $sql2  = "UPDATE mapsrv.mps04_prj_cam ";
	$sql2 .= "SET mps04_nm_ordem = " . $nm_ordem_atu;
	$sql2 .= " WHERE mps01_cd_prj = '" . $cd_prj . "'";
	$sql2 .= "  AND mps03_cd_camada = " . $cd_camada .";";

  print 'SQL2='. $sql2;

	try {
    $result = pg_query($database, $sql2);
    $_SESSION['message'] = 'Registro atualizado com sucesso.';
    $_SESSION['type'] = 'success';
  } catch (Exception $e) {
    $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
    $_SESSION['type'] = 'danger';
  }



  close_database($database);

}

/**
 *  troca a desce a ordem de apresentação da camadas
 */

function down_ordem($cd_prj = null, $nm_ordem_ant = 0, $cd_camada = 0){
  $database = open_database();
  $nm_ordem_atu = $nm_ordem_ant + 1;

	$sql  = "UPDATE mapsrv.mps04_prj_cam ";
	$sql .= "SET mps04_nm_ordem = " . $nm_ordem_ant;
	$sql .= " WHERE mps01_cd_prj = '" . $cd_prj . "'";
	$sql .= "  AND mps04_nm_ordem =" . $nm_ordem_atu . ";";

  print 'SQL1='. $sql;

	try {
    $result = pg_query($database, $sql);
    $_SESSION['message'] = 'Registro atualizado com sucesso.';
    $_SESSION['type'] = 'success';
  } catch (Exception $e) {
    $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
    $_SESSION['type'] = 'danger';
  }


  $sql2  = "UPDATE mapsrv.mps04_prj_cam ";
	$sql2 .= "SET mps04_nm_ordem = " . $nm_ordem_atu;
	$sql2 .= " WHERE mps01_cd_prj = '" . $cd_prj . "'";
	$sql2 .= "  AND mps03_cd_camada = " . $cd_camada .";";

  print 'SQL2='. $sql2;

	try {
    $result = pg_query($database, $sql2);
    $_SESSION['message'] = 'Registro atualizado com sucesso.';
    $_SESSION['type'] = 'success';
  } catch (Exception $e) {
    $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
    $_SESSION['type'] = 'danger';
  }



  close_database($database);

}

// ====> Scripts de exclusão

/**
 *  Remove uma linha de uma tabela pelo ID do registro
 */
function remove( $table = null, $id = null, $chave ) {
  $database = open_database();

  try {
    if ($id) {
      $sql = "DELETE FROM " . $table . " WHERE " . $chave . "= '" . $id . "'";
      $result = pg_query($database, $sql);
			if($result) {
				$_SESSION['message'] = 'Registro removido com sucesso.';
		    $_SESSION['type'] = 'success';
			} else {
				$_SESSION['message'] = pg_last_error($database);
				$_SESSION['type'] = 'danger';
			}
    }
  } catch (Exception $e) {
    $_SESSION['message'] = $e->GetMessage();
    $_SESSION['type'] = 'danger';
  }
  close_database($database);
}


/**
 *  Remove dados da tabela CAMPRJ e altera a ordem
 */
function delete_camprj( $cd_prj = null, $nm_ordem = null ) {
  $database = open_database();

  try {
      $sql  = "DELETE FROM mapsrv.mps04_prj_cam";
			$sql .= " WHERE mps01_cd_prj = '" . $cd_prj . "'";
			$sql .= "   AND mps04_nm_ordem = " . $nm_ordem . ";";

			$result = pg_query($database, $sql);

      $sql  = "UPDATE mapsrv.mps04_prj_cam";
			$sql .= "   SET mps04_nm_ordem = mps04_nm_ordem - 1";
			$sql .= " WHERE mps01_cd_prj = '" . $cd_prj . "'";
			$sql .= "   AND mps04_nm_ordem > " . $nm_ordem . ";";

			$result = pg_query($database, $sql);

			if($result) {
				$_SESSION['message'] = 'Registro atualizado com sucesso.';
		    $_SESSION['type'] = 'success';
			} else {
				$_SESSION['message'] = pg_last_error($database);
				$_SESSION['type'] = 'danger';
			}


  } catch (Exception $e) {
    $_SESSION['message'] = $e->GetMessage();
    $_SESSION['type'] = 'danger';
  }
  close_database($database);
}

function clear_messages() {
  $_SESSION['message'] = null;
	$_SESSION['type'] = null;
}



?>
