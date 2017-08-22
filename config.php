<?php
/** O nome do banco de dados*/
define('DB_NAME', 'mapas');
/** Usuário do banco de dados Postgres */
define('DB_USER', 'postgres');
/** Senha do banco de dados Postgres */
define('DB_PASSWORD', '123456');
/** nome do host do Postgres */
define('DB_HOST', '192.168.100.204');
/** porta do servidor de bd 8**/
define('DB_PORT','5432');

/** STRIG DE CONEXÃO UTILIZADA!!! **/
define('DB_STRING', 'host='. DB_HOST . ' dbname=' . DB_NAME . ' port=' . DB_PORT . ' user=' . DB_USER . ' password=' . DB_PASSWORD);

/** caminho absoluto para a pasta do sistema **/
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** caminho no server para o sistema **/
if ( !defined('BASEURL') )
	define('BASEURL', '/');

/** caminho do arquivo de banco de dados **/
if ( !defined('DBAPI') )
	define('DBAPI', ABSPATH . 'inc/database.php');

/** caminhos dos templates de header e footer **/
define('MODAL_EXCLUIR', ABSPATH . 'inc/modal.php');
define('HEADER_TEMPLATE', ABSPATH . 'inc/header.php');
define('HEADER_TEMPLATE_FULL', ABSPATH . 'inc/header-full.php');
define('FOOTER_TEMPLATE', ABSPATH . 'inc/footer.php');

/** inicia a sessão **/
// ===>>> verificar se deve ficar aqui ou na página INDEX do projeto...
session_start();


?>
