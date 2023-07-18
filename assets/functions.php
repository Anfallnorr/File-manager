<?php

// use Jsinfo\Langs;

Global $exectutionTimeStart;
$exectutionTimeStart = microtime(true);

/* ************************************************************* */
/* *************************** DEBUG *************************** */
/* ************************************************************* */
function debug($debug, bool $bool = false): void {
	Global $exectutionTimeStart;
	
	$debug_backtrace = debug_backtrace();
	echo '<div id="function_debug" class="ml-240 mt-50"><div class="row"><div class="col-md-12">';
	echo '<div class="degug-function"><button type="button" class="btn-close btn-close-white debug-close" aria-label="Close"></button><div class="degug-backtrace"><ul>';
	foreach($debug_backtrace as $backtrace) {
		echo '<li><strong>'. str_replace(_ROOTURL_, "", $backtrace['file']) .'</strong> Ligne.'. $backtrace['line'] .'</li>';/* echo '<li><strong>'. str_replace("/homepages/3/d790170865/htdocs/crm-jsinfo", "", $backtrace['file']) .'</strong> Ligne.'. $backtrace['line'] .'</li>'; */
	}
	echo '</ul>';
	echo '</div><div class="degug-path"><code><pre>';
	print_r($debug);
	echo '</pre></code></div>';
	// echo '<p>Temps d\'execution de la fonction : '. (microtime(true) - $exectutionTimeStart) .' s</p></div>';
	echo '<p>Temps d\'execution de la fonction : '. number_format(microtime(true) - $exectutionTimeStart, 3) .' s</p></div>';
	echo '</div></div></div>';
	if( $bool === true ) {
		die;
	}
}

function dump($debug): void {
	echo 'Pas dump mais <strong>debug</strong><br />';
}

?>