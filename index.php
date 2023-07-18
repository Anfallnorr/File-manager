<?php 
define('_ROOTURL_', $_SERVER['DOCUMENT_ROOT']);

require _ROOTURL_ ."/includes.php";

new Controllers();
// debug(_ROOTURL_);
// debug($viewOut);
?>