<?php

defined('_EXEC') or die;

if( file_exists(_ROOTURL_ .'/includes/functions.php') ) {
	require _ROOTURL_ ."/includes/functions.php"; /* Liste des fonctions */
}
if( file_exists(_ROOTURL_ .'/includes/router.php') ) {
	require _ROOTURL_ ."/includes/router.php"; /* Reçois les URLs */
}
if( file_exists(_ROOTURL_ .'/includes/dispatchers.php') ) {
	require _ROOTURL_ ."/includes/dispatchers.php"; /* Traite les URLs */
}
if( file_exists(_ROOTURL_ .'/includes/models.php') ) {
	require _ROOTURL_ ."/includes/models.php"; /* Requetes SQL */
}
if( file_exists(_ROOTURL_ .'/includes/controllers.php') ) {
	require _ROOTURL_ ."/includes/controllers.php"; /* Liaison entre le models et la vue */
}

if( file_exists(_ROOTURL_ .'/classes/images.php') ) {
	require _ROOTURL_ ."/classes/images.php"; // Traitement d'images
}
if( file_exists(_ROOTURL_ .'/classes/uploader.php') ) {
	require _ROOTURL_ ."/classes/uploader.php"; // Traitement d'uploads
}
if( file_exists(_ROOTURL_ .'/classes/filesystems.php') ) {
	// debug('/classes/filesystems.php');
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