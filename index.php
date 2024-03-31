<?php

if (!defined('MINIMUM_PHP')) {
	define('MINIMUM_PHP', "8.1.0");
}
if (version_compare(PHP_VERSION, MINIMUM_PHP, "<")) {
	die("Votre version de php : ". PHP_VERSION ." doit être supérieur à ". MINIMUM_PHP ." pour exécuter cette version de Js-info !");
}

if (in_array($_SERVER['REQUEST_URI'], array("", "/", "/index.php"))) {
	header('Location: /datas/data');
	exit;
}

define('_EXEC', 1);

require "configuration.php";
$config = new Config();

/* ***** DOCUMENT_ROOT ***** */
define('_ROOTURL_', $config->root_path);
require "includes/includes.php";

if ($config->debug === 1) {
	$mod_debug = $config->error_reporting;
	
	if ($mod_debug === "none") {error_reporting(0);} 
	elseif ($mod_debug === "minimum") {error_reporting(E_NOTICE);} 
	elseif ($mod_debug === "default") {error_reporting(E_WARNING | E_PARSE);} 
	elseif ($mod_debug === "maximum") {error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);} 
	elseif ($mod_debug === "development") {
		error_reporting(E_ALL);
	}
} else {
	error_reporting(0);
}

new Dispatchers();

?>
