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

/** STRING DE CONEXÃO **/
define('DB_STRING', 'host='. DB_HOST . ' dbname=' . DB_NAME . ' port=' . DB_PORT . ' user=' . DB_USER . ' password=' . DB_PASSWORD);

/** caminho absoluto para a pasta do sistema **/
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** caminho no server para o sistema **/
if ( !defined('BASEURL') )
	define('BASEURL', '/MPOSRVR');

/** caminho do arquivo de banco de dados **/
if ( !defined('DBAPI') )
	define('DBAPI', ABSPATH . 'inc/database.php');

/** caminhos dos templates de header e footer **/
define('MODAL_EXCLUIR', ABSPATH . 'inc/modal.php');
define('HEADER_TEMPLATE', ABSPATH . 'inc/header.php');
define('HEADER_TEMPLATE_FULL', ABSPATH . 'inc/header-full.php');
define('FOOTER_TEMPLATE', ABSPATH . 'inc/footer.php');

/** chaves apis de desenvolvimento **/
define('GOOGLE_API', 'AIzaSyDgb_oO59XzVV7PkxUlPRjhy7XyXoWRpNk');
define('BING_API', 'y6pv7g8PpkZ6Te2uldDM~87tLBHHyig0oTltPVn0Zgg~AimjkBSsPcR4J1cG3j1mLqdimI1YGNIaAfOV3ydMY2mayLU_o_zsNNJfUgl_AIOw');

/** Configurações de autorização */
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');


/** inicia a sessão **/
// ===>>> verificar se deve ficar aqui ou na página INDEX do projeto...
session_start();


?>
