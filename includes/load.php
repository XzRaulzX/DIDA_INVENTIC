<?php
// -----------------------------------------------------------------------
//Versión ADADI 2.0
// Incluido el require para la gestión de correo electrónico
// -----------------------------------------------------------------------
// -----------------------------------------------------------------------
// DEFINE LOS ALIAS DE LOS SEPARADORES
// -----------------------------------------------------------------------
define("URL_SEPARATOR", '/');

define("DS", DIRECTORY_SEPARATOR);

// -----------------------------------------------------------------------
// DEFINE LOS ROOT PATHS
// -----------------------------------------------------------------------
defined('SITE_ROOT')? null: define('SITE_ROOT', realpath(dirname(__FILE__)));
define("LIB_PATH_INC", SITE_ROOT.DS);


require_once(LIB_PATH_INC.'config.php');
require_once(LIB_PATH_INC.'functions.php');
require_once(LIB_PATH_INC.'session.php');
require_once(LIB_PATH_INC.'upload.php');
require_once(LIB_PATH_INC.'database.php');
require_once(LIB_PATH_INC.'sql.php');
require_once(LIB_PATH_INC.'correo.php'); // Servicio de correo electrónico mayo 2021
?>