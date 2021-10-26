<?php
// -----------------------------------------------------------------------
// DEFINE SEPERATOR ALIASES
// -----------------------------------------------------------------------
define("URL_SEPARATOR", '/');
define("DS", DIRECTORY_SEPARATOR);
define('RAIZ', dirname(__FILE__));
// -----------------------------------------------------------------------
// DEFINE ROOT PATHS
// -----------------------------------------------------------------------
defined('SITE_ROOT')? null: define('SITE_ROOT', realpath(dirname(__FILE__)));
define("LIB_PATH_INC", SITE_ROOT.DS);
date_default_timezone_set('America/Argentina/Buenos_Aires');
date_default_timezone_get();

require_once(LIB_PATH_INC.'configs/config.php');
require_once(LIB_PATH_INC.'configs/functions.php');
require_once(LIB_PATH_INC.'configs/session.php');
require_once(LIB_PATH_INC.'configs/databases/construcciones.php');
require_once(LIB_PATH_INC.'configs/databases/expedientes.php');
require_once(LIB_PATH_INC.'configs/sql.php');
?>
