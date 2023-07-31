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
	echo '<div id="function_debug" class="ml-240 mt-50">
		<div class="row">
			<div class="col-md-12">
				<div class="degug-function">
					<button type="button" class="btn-close btn-close-white debug-close" aria-label="Close"></button>
					<div class="degug-backtrace">
						<ul>';
							foreach($debug_backtrace as $backtrace) {
								echo '<li><strong>'. str_replace(_ROOTURL_, "", $backtrace['file']) .'</strong> Ligne.'. $backtrace['line'] .'</li>';
							}
						echo '</ul>
					</div>
					<div class="degug-path">
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
	if( $bool === true ) {
		die;
	}
}

function dump($debug): void {
	echo 'Pas dump mais <strong>debug</strong><br />';
}

/* ************************************************************* */
/* *********************** REQUIRE MULTI *********************** */
/* ************************************************************* */
// require_multi(_ROOTURL_ .'/config/configcontrollers.php', _ROOTURL_ .'/config/configviews.php', _ROOTURL_ .'/config/configfunctions.php');
function require_multi(string $files): void {
    $files = func_get_args();
    foreach($files as $file) {
        require($file);
	}
}

/* ********************************************************* */
/* *********************** IN ARRAYS *********************** */
/* ********************************************************* */
// in_arrays($this->requests->view, $page_views)
// in_arrays(
	// in_arrays($this->requests->view, $page_views), $this->requests->seos, "id", "id_page_view"
// )
function in_arrays(array|string|int|null $needle, array $haystack, int|string $indexNeedle = "", int|string $indexHaystack = ""): ?array {
	if( !is_null($needle) ) {
		if( !empty($indexNeedle) && !empty($indexHaystack) ) {
			foreach($haystack as $value) {
				if( $needle[$indexNeedle] === $value[$indexHaystack] ) {
					return $value;
				}
			}
		} else {
			foreach($haystack as $value) {
				if( in_array($needle, $value) ) {
					return $value;
				}
			}
		}
	}
	return null;
}

/* ************************************************************* */
/* *********************** ARRAYS UNIQUE *********************** */
/* ************************************************************* */
// arrays_unique(
	// in_arrays($this->requests->view, $page_views), $this->requests->seos, "id", "id_page_view"
// )
function arrays_unique(array $needle, string $byKey = "", bool $keepKey = false): ?array {
	if( !is_null($needle) ) {
		if (empty($byKey)) {
			$uniqueArray = array_map("unserialize", array_unique(array_map("serialize", $needle)));
		} else {
			// Utilisation de array_reduce() pour dédoublonner le tableau
			$uniqueData = array_reduce($needle, function ($carry, $item) use ($byKey) {
				$key = strval($item[$byKey]);
				
				if (!isset($carry[$key])) {
					$carry[$key] = $item;
				}
				
				return $carry;
			}, array());
		}
		
		// Réindexation des clés du tableau résultant si $keepKey = false
		$uniqueData = (!$keepKey) ? array_values($uniqueData) : $uniqueData;
		
		return $uniqueData ?? null;
	}
	return null;
}

/* ******************************************************************* */
/* *********************** ARRAYS COUNT VALUES *********************** */
/* ******************************************************************* */
function arrays_count_values(array $needle, string $byKey = "", string $bySubKey = ""): ?array {
	if( !is_null($needle) ) {
		$keys = array($byKey, $bySubKey);
		
		$count = array_reduce($needle, function($carry, $item) use ($keys) {
			if (isset($item[$keys[0]]) && !empty($item[$keys[0]])) {
				$carry[$item[$keys[0]]] = isset($carry[$item[$keys[0]]]) ? $carry[$item[$keys[0]]] + 1 : 1;
			} elseif (isset($item[$keys[1]])) {
				$carry[$item[$keys[1]]] = isset($carry[$item[$keys[1]]]) ? $carry[$item[$keys[1]]] + 1 : 1;
			}
			
			return $carry;
		}, array());
		
		return $count ?? null;
	}
	return null;
}

/* ******************************************************************* */
/* ************************ ARRAYS MULTI SORT ************************ */
/* ******************************************************************* */
function arrays_multisort(array $needle, string $column): array {
	// Obtenez un tableau des "country_name" pour trier
	$names = array_column($needle, $column);
	
	// Tri du tableau principal en utilisant les "$column"
	array_multisort($names, $needle);
	
	// Tableau final trié par "country_name" avec les données correspondantes
	$sorted = array();
	
	foreach ($needle as $value) {
		$name = strtolower($value[$column]);
		
		$sorted[$name][] = $value;
	}
	
	// Affichage des résultats
	return $sorted;
}

/* ******************************************************************** */
/* ************************* GET EXPLODE FILE ************************* */
/* ******************************************************************** */
// getExplodeFile(_ROOTURL_ ."/var/tmp/navs.log", "|")
function getExplodeFile(string $file, string $separator = "|"): ?array {
	// Ouvrez le fichier en mode lecture
	$handle = fopen($file, "r");
	
	// Tableau pour stocker les lignes du fichier
	$results = array();
	
	// Parcourez le fichier ligne par ligne
	while (($line = fgets($handle)) !== false) {
		// Utilisez explode() pour séparer chaque ligne en tableau
		$lineArray = explode($separator, $line);
		
		// Ajoutez le tableau de la ligne à votre tableau de lignes
		$results[] = $lineArray;
	}
	
	// Fermez le fichier
	fclose($handle);
	
	return $results;
}

/* ******************************************************************** */
/* ************************* GET EXPLODE FILE ************************* */
/* ******************************************************************** */
function randStr($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
	
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
	
    return $randomString;
}

/* **************************************************************** */
/* *********************** GET STYLE DEVICE *********************** */
/* **************************************************************** */
function getStyleDevice(string $needles): array {
	if ( preg_match('/iphone/i', $needles) || preg_match('/android/i', $needles) || preg_match('/blackberry/i', $needles) || preg_match('/symb/i', $needles) || preg_match('/ipad/i', $needles) || preg_match('/ipod/i', $needles) || preg_match('/phone/i', $needles) ) {
		$mobile['css_link'] = '<link href="/assets/css/style-mobile.css" type="text/css" rel="stylesheet">';
		$mobile['js_link'] = '<script src="/assets/js/style-mobile.js" type="text/javascript" rel="stylesheet"></script>';
		$mobile['class'] = ' mobile-device';
	} else {
		$mobile['css_link'] = "";
		$mobile['js_link'] = "";
		$mobile['class'] = " desktop-device";
	}
	
	return $mobile;
}

/* ******************************************************* */
/* *********************** LANG DATE *********************** */
/* ******************************************************* */
function langDate(string $needle, string $isoLang = "fr"): string {
	$en = [
		"Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday",
		"Mon","Tue","Wed","Thu","Fri","Sat","Sun",
		"January","February","March","April","May","June","July","August","September","October","November","December",
		"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"
	];
	$fr = [
		"Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche",
		"Lun","Mar","Mer","Jeu","Ven","Sam","Dim",
		"Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Decembre",
		"Jan","Fév","Mar","Avr","Mai","Jui","Jui","Aoû","Sep","Oct","Nov","Dec"
	];
	$de = [
		"Montag","Dienstag","Mittwoch","Donnerstag","Freitag","Samstag","Sonntag",
		"Mon","Die","Mit","Don","Fre","Sam","Son",
		"Januar","Februar","März","April","Mai","Juni","Juli","August","September","Oktober","November","Dezember",
		"Jan","Feb","Mär","Apr","Mai","Jun","Jul","Aug","Sep","Okt","Nov","Dez"
	];
	
	if( $isoLang == "fr" ) {
		return str_replace($en, $fr, $needle);
	} elseif( $isoLang == "de" ) {
		return str_replace($en, $de, $needle);
	} else {
		return $needle;
	}
}

/* ****************************************************** */
/* *********************** GET IP *********************** */
/* ****************************************************** */
function getIp() {
	// récupère l'adresse IP de l'utilisateur
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		// IP si internet partagé
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		// IP derrière un proxy
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		// Sinon : IP normale
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	
	// si l'adresse IP est une adresse IPv6, on récupère l'adresse IPv4
	if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
		$ipv4 = '';
		$ipv6_array = explode(':', $ip);
		
		// on parcourt les parties de l'adresse IPv6 à la recherche de l'adresse IPv4
		foreach ($ipv6_array as $part) {
			// si on a trouvé l'adresse IPv4, on l'enregistre et on sort de la boucle
			if (filter_var($part, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
				$ipv4 = $part;
				break;
			}
		}
		
		// si on a trouvé l'adresse IPv4, on l'utilise, sinon on utilise l'adresse IPv6
		return $ipv4 ?: $ip;
	} else {
		return $ip;
	}
}

function getGeoIp(bool $addLocation = true, bool $addNearby = true): ?array {
	$results = array();
	$ip = getIp();
	$geoplugin = new geoPlugin();
	// Si nous voulions changer la devise de base, nous décommenterions la ligne suivante
	$geoplugin->locate($ip);
	
	if (!is_null($geoplugin->ip)) {
		$results['location'] = array(
			'ip' => $geoplugin->ip,
			'city' => $geoplugin->city,
			'region' => $geoplugin->region,
			'region_code' => $geoplugin->regionCode,
			'region_name' => $geoplugin->regionName,
			'country_name' => $geoplugin->countryName,
			'country_code' => $geoplugin->countryCode,
			'timezone' => $geoplugin->timezone,
			'latitude' => $geoplugin->latitude,
			'longitude' => $geoplugin->longitude,
			'currency_code' => $geoplugin->currencyCode
		);
		
		if ($addLocation == true) {
			$results['location'] = array_merge(
				$results['location'],
				array(
					'in_eu' => $geoplugin->inEU,
					'eu_vat_rate' => $geoplugin->euVATrate,
					'dma_code' => $geoplugin->dmaCode,
					'location_accuracy_radius' => $geoplugin->locationAccuracyRadius,
					'currency_symbol' => $geoplugin->currencySymbol,
					'currency_converter' => $geoplugin->currencyConverter
				)
			);
		}
		
		if ($geoplugin->currency != $geoplugin->currencyCode) {
			// Notre visiteur n'utilise pas la même devise que la devise de base
			$results['convert'] = "Au taux d'aujourd'hui, 100 $ US vous coûteront " . $geoplugin->convert(100);
		}
		
		// Trouver des endroits à proximité
		$nearby = $geoplugin->nearby();
		
		if ($addNearby == true && isset($nearby[0]['geoplugin_place'])) {
			$results['nearby']['intro'] = "Some places you may wish to visit near " . $geoplugin->city . " :";
			
			foreach ( $nearby as $key => $array ) {
				$results['nearby'][$key] = array(
					'place' => $array['geoplugin_place'],
					'country_code' => $array['geoplugin_countryCode'],
					'region' => $array['geoplugin_region'],
					// 'county' => $array['geoplugin_county'],
					'latitude' => $array['geoplugin_latitude'],
					'longitude' => $array['geoplugin_longitude'],
					'distance_miles' => $array['geoplugin_distanceMiles'],
					'distance_kilometers' => $array['geoplugin_distanceKilometers']
				);
			}
		}
		
		return $results;
	} else {
		return null;
	}
	
}

/* ************************************************************** */
/* **************** CALCUL TTC / HT / TVA / PROMO *************** */
/* ************************************************************** */
// Avec la valeur décimale de TVA = taux de TVA/100
function getHt(int|float $tax, int|float $ttc): int|float {
	// PV HT =  Px TTC / (1+valeur décimale de TVA)
	$getTax = $tax / 100;
	$getPriceHt = $ttc / (1 + $getTax);
	
	return number_format($getPriceHt, 2, '.', '');
}
// $product['price'] - (($product['price'] * $product['promo']) / 100)
function getTtc(int|float $tax, int|float $ht): int|float {
	// PV TTC = Px HT * (1+ valeur décimale de TVA)
	$getTax = $tax / 100;
	$getPriceTtc = $ht * (1 + $getTax);
	
	return number_format($getPriceTtc, 2, '.', '');
}

function getTva(int|float $tax, int|float $ht): int|float {
	// TVA = PV HT * valeur décimale de TVA
	$getTax = $tax / 100;
	$getPriceTva = $ht * $getTax;
	
	return number_format($getPriceTva, 2, '.', '');
}

function getPromo(int|float $price, int|float $promo): int|float {
	// REMISE = Price - ((Price * Promo) / 100)
	return $price - (($price * $promo) / 100);
}

/* *************************************************************** */
/* ********************* GET PERSONNAL FOLDER ******************** */
/* *************************************************************** */
function getPersonnalFolder(int $id): string {
	return md5($id) ."-". $id;
}

/* ******************************************************* */
/* ******************* REMOVE BACKSPACE ****************** */
/* ******************************************************* */
function removeBackspace(string $text, string $symbol, bool $pregReplace = false): string {
	// $text = "Hello World !";
	if( $pregReplace == true ) {
		// $newText = preg_replace('/[^A-Za-z0-9 ]/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $text)); //supprime les caractères spéciaux et accentués
		$newText = preg_replace('/[^\p{L}\p{N} ]/u', '', iconv('UTF-8', 'ASCII//TRANSLIT', $text)); // supprime les caractères spéciaux et accentués
		
		// Supprimer les symboles spécifiés
		$symbolsToRemove = array(',', '\'', '"', ';', ':', '-', '_', '.', '(', ')', '[', ']', '+', '=');
		foreach ($symbolsToRemove as $symbolToRemove) {
			$newText = str_replace($symbolToRemove, '', $newText);
		}
	} else {
		$newText = $text;
	}
	
	$newText = str_replace(' ', $symbol, $newText);
	
	// Supprimer le symbole en début de chaîne s'il y a
	if (strpos($newText, $symbol) === 0) {
		$newText = substr($newText, 1);
	}
	
	// Supprimer le symbole en fin de chaîne s'il y a
	if (substr($newText, -1) == $symbol) {
		$newText = substr($newText, 0, -1);
	}
	
	return $newText;
}

/* ******************************************************** */
/* ********************* ADD BACKSPACE ******************** */
/* ******************************************************** */
function addBackspace(string $text, string $symbol): string {
	return str_replace($symbol, " ", $text);
}

/* ******************************************************** */
/* ************************ REPLACE *********************** */
/* ******************************************************** */
function replace(string $string, string $symbol = "_"): string {
	$search  = array(
		"À", "Â", "Ä", "Ã", "Æ", "Å", "Ā", "Ă", "Ą", "Á", "à", "â", "ä", "ã", "æ", "å", "ā", "ă", "ą", "á", 
		"Ç", "ç", 
		"É", "È", "Ê", "Ë", "Ē", "Ė", "Ę", "Ě", "Ĕ", "Ə", "é", "è", "ê", "ë", "ē", "ė", "ę", "ě", "ĕ", "ə", 
		"Í", "Ì", "Î", "Ï", "Ī", "Į", "ı", "í", "ì", "î", "ï", "ī", "į", "ı", 
		"Ñ", "ñ", 
		"Ó", "Ò", "Ô", "Ö", "Ø", "Õ", "Ō", "Ő", "Œ", "ó", "ò", "ô", "ö", "ø", "õ", "ō", "ő", "œ", 
		"Ú", "Ù", "Û", "Ü", "Ū", "Ů", "Ű", "Ų", "ú", "ù", "û", "ü", "ū", "ů", "ű", "ų", 
		"Ÿ", "Ý", "ÿ", "ý", 
	);
	$replace = array(
		"A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", 
		"C", "c", 
		"E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", 
		"I", "I", "I", "I", "I", "I", "I", "i", "i", "i", "i", "i", "i", "i", 
		"N", "n", 
		"O", "O", "O", "O", "O", "O", "O", "O", "O", "o", "o", "o", "o", "o", "o", "o", "o", "o", 
		"U", "U", "U", "U", "U", "U", "U", "U", "u", "u", "u", "u", "u", "u", "u", "u", 
		"Y", "Y", "y", "y", 
	);
	
	return str_replace(" ", $symbol, strtolower(str_replace($search, $replace, $string)));
}

function _getAlias($str){            
	if($str !== mb_convert_encoding( mb_convert_encoding($str, 'UTF-32', 'UTF-8'), 'UTF-8', 'UTF-32') )
		$str = mb_convert_encoding($str, 'UTF-8', mb_detect_encoding($str));
	
	$str = htmlentities($str, ENT_NOQUOTES, 'UTF-8');
	$str = preg_replace('`&([a-z]{1,2})(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i', '\\1', $str);
	$str = html_entity_decode($str, ENT_NOQUOTES, 'UTF-8');
	$str = preg_replace(array('`[^a-z0-9]`i','`[-]+`'), '-', $str);
	$str = strtolower( trim($str, '-') );            
	
	return $str;
}

?>