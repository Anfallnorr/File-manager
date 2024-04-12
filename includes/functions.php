<?php

Global $exectutionTimeStart;
$exectutionTimeStart = microtime(true);

/* ************************************************************* */
/* *************************** DEBUG *************************** */
/* ************************************************************* */
function debug($debug, bool $bool = false): void
{
	Global $exectutionTimeStart;
	
	$debug_backtrace = debug_backtrace();
	echo '<div id="function_debug" class="ml-240 mt-50">
		<div class="row">
			<div class="col-md-12">
				<div class="debug-function">
					<button type="button" class="btn-close btn-close-white debug-close" aria-label="Close"></button>
					<div class="debug-backtrace">
						<ul>';
							foreach($debug_backtrace as $backtrace) {
								echo '<li><strong>'. str_replace(_ROOTURL_, "", $backtrace['file']) .'</strong> Ligne.'. $backtrace['line'] .'</li>';
							}
						echo '</ul>
					</div>
					<div class="debug-path">
						<code>
							<pre>';
								print_r($debug);
							echo '</pre>
						</code>
					</div>
					<p>Temps d\'execution de la fonction : '. number_format(microtime(true) - $exectutionTimeStart, 3) .' s</p>
				</div>
			</div>
		</div>
	</div>';
	if ($bool === true) {
		die;
	}
}

/* ********************************************************* */
/* *********************** IN ARRAYS *********************** */
/* ********************************************************* */
function in_arrays(array|string|int|null $needle, array $haystack, int|string $indexNeedle = "", int|string $indexHaystack = ""): ?array
{
	if (!is_null($needle)) {
		if (!empty($indexNeedle) && !empty($indexHaystack)) {
			foreach ($haystack as $value) {
				if ($needle[$indexNeedle] === $value[$indexHaystack]) {
					return $value;
				}
			}
		} else {
			foreach($haystack as $value) {
				if (in_array($needle, $value)) {
					return $value;
				}
			}
		}
	}
	return null;
}

/* *************************************************************** */
/* ********************* GET PERSONNAL FOLDER ******************** */
/* *************************************************************** */
function getPersonnalFolder(int $id): string
{
	return md5($id) ."-". $id;
}

?>
