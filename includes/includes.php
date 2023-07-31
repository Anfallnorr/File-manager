<?php

defined('_EXEC') or die;

if( file_exists(_ROOTURL_ .'/includes/functions.php') ) {
	require _ROOTURL_ ."/includes/functions.php";
}
if( file_exists(_ROOTURL_ .'/includes/router.php') ) {
	require _ROOTURL_ ."/includes/router.php";
}
if( file_exists(_ROOTURL_ .'/includes/dispatchers.php') ) {
	require _ROOTURL_ ."/includes/dispatchers.php";
}
if( file_exists(_ROOTURL_ .'/includes/controllers.php') ) {
	require _ROOTURL_ ."/includes/controllers.php";
}

if( file_exists(_ROOTURL_ .'/classes/filesystems.php') ) {
	require _ROOTURL_ ."/classes/filesystems.php"; // Traitement de dossier/fichier
}
if( file_exists(_ROOTURL_ .'/classes/archiver.php') ) {
	require _ROOTURL_ ."/classes/archiver.php"; // Traitement de dossier/fichier
}
if( file_exists(_ROOTURL_ .'/classes/downloader.php') ) {
	require _ROOTURL_ ."/classes/downloader.php"; // Téléchargement de fichier
}
if( file_exists(_ROOTURL_ .'/includes/requests.php') ) {
	require _ROOTURL_ ."/includes/requests.php";
}
if( file_exists(_ROOTURL_ .'/includes/sessions.php') ) {
	require _ROOTURL_ ."/includes/sessions.php";
}

?>
