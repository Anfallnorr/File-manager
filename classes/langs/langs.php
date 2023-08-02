<?php

// namespace Jsinfo\Langs;

defined('_EXEC') or die;

class Langs {
	
	public $config;
	public $params;
	public $customer;
	public $lang;
	
	function __construct(object $config, string $defaultLang = "", array $params = [], array $customer = []) {
		$this->config = $config;
		$this->params = $params;
		$this->customer = $customer;
		
		// $this->lang = $this->config->default_lang;
		$this->lang = !empty($defaultLang) ? $defaultLang : $this->config->default_lang;
		
		// debug($config);
		// debug($defaultLang);
		// debug($params);
		// debug($customer, true);
	}
	
	// function lang(string $needle, string $controller = "", bool $return = false): string|null {
	function lang(string $needle, string $controller = "", bool $return = false): ?string {
		// $lang = $this->config->default_lang;
		
		if( $controller == "" ) {
			$controller = "theme";
		}
		// debug($needle);
		// die;
		
		// $ini_file = "/language/". $lang ."/". $lang .".". $controller .".ini";
		$ini_file = "/language/". $this->lang ."/". $this->lang .".". $controller .".ini";
		
		if( file_exists(_ROOTURL_ . $ini_file) ) {
			$get_translation = parse_ini_file(_ROOTURL_ . $ini_file, true, INI_SCANNER_NORMAL);
			// print_r($get_translation[$needle]);
			
			if( array_key_exists($needle, $get_translation) ) {
				$needle = $get_translation[$needle];
			}
			// print_r($ini_array);
		}
		
		if( $return == true ) {
			return $needle;
		} else {
			echo $needle;
			return null;
		}
	}
	
	/*
	function langForm(string $needle, string $tag = "", array $attr = [], string $controller = ""): void {
		// $lang = $this->config->default_lang;
		
		if( $controller == "" ) {
			$controller = "forms";
		}
		// debug($needle);
		// debug($tag);
		// debug($attr);
		// die;
		
		$ini_file = "/language/". $this->lang ."/". $this->lang .".". $controller .".ini";
		
		if( file_exists(_ROOTURL_ . $ini_file) ) {
			$get_translation = parse_ini_file(_ROOTURL_ . $ini_file, true, INI_SCANNER_NORMAL);
			// print_r($get_translation[$needle]);
			
			if( array_key_exists($needle, $get_translation) ) {
				$needle = $get_translation[$needle];
			}
			// print_r($ini_array);
		}
		
		if( !empty($tag) ) {
			// debug('<'. $tag .' '. implode(" ", $attr) .'>'. $needle .'</'. $tag .'>');
			// die;
			echo '<'. $tag .' '. implode(" ", $attr) .'>'. $needle .'</'. $tag .'>';
		} else {
			echo $needle;
		}
	}
	*/
	
	function getFileInArray(string $controller): null|array {
		// $lang = $this->config->default_lang;
		
		// debug($needle);
		// debug($tag);
		// debug($attr);
		// die;
		
		$ini_file = "/language/". $this->lang ."/". $this->lang .".". $controller .".ini";
		
		if( file_exists(_ROOTURL_ . $ini_file) ) {
			$get_translation = parse_ini_file(_ROOTURL_ . $ini_file, true, INI_SCANNER_NORMAL);
		}
		
		if( !empty($get_translation) ) {
			return $get_translation;
		} else {
			return null;
		}
	}
	
	public function getDays(int $key = 0): array {
		$isoLang = substr($this->lang, 0, 2);
		
		if ($isoLang == "fr") {
			$days = array(
				array(1 => "Lundi", 2 => "Mardi", 3 => "Mercredi", 4 => "Jeudi", 5 => "Vendredi", 6 => "Samedi", 7 => "Dimanche"),
				array(1 => "Lun", 2 => "Mar", 3 => "Mer", 4 => "Jeu", 5 => "Ven", 6 => "Sam", 7 => "Dim"),
				array(1 => "L", 2 => "M", 3 => "M", 4 => "J", 5 => "V", 6 => "S", 7 => "D")
			);
		}
		elseif ($isoLang == "en") {
			$days = array(
				array(1 => "Monday", 2 => "Tuesday", 3 => "Wednesday", 4 => "Thursday", 5 => "Friday", 6 => "Saturday", 7 => "Sunday"),
				array(1 => "Mon", 2 => "Tue", 3 => "Wed", 4 => "Thu", 5 => "Fri", 6 => "Sat", 7 => "Sun"),
				array(1 => "M", 2 => "T", 3 => "W", 4 => "T", 5 => "F", 6 => "S", 7 => "S")
			);
		}
		elseif ($isoLang == "de") {
			$days = array(
				array(1 => "Montag", 2 => "Dienstag", 3 => "Mittwoch", 4 => "Donnerstag", 5 => "Freitag", 6 => "Samstag", 7 => "Sonntag"),
				array(1 => "Mon", 2 => "Die", 3 => "Mit", 4 => "Don", 5 => "Fre", 6 => "Sam", 7 => "Son"),
				array(1 => "M", 2 => "D", 3 => "M", 4 => "D", 5 => "F", 6 => "S", 7 => "S")
			);
		}
		
		return $days[$key];
	}
	
	public function getMonths(int $key = 0): array {
		$isoLang = substr($this->lang, 0, 2);
		
		if ($isoLang == "fr") {
			$months = array(
				array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"),
				// array('01' => "Janvier", '02' => "Février", '03' => "Mars", '04' => "Avril", '05' => "Mai", '06' => "Juin", '07' => "Juillet", '08' => "Août", '09' => "Septembre", '10' => "Octobre", '11' => "Novembre", '12' => "Décembre"),
				array("Jan", "Fév", "Mar", "Avr", "Mai", "Jui", "Jui", "Aoû", "Sep", "Oct", "Nov", "Déc"),
				// array('01' => "Jan", '02' => "Fév", '03' => "Mar", '04' => "Avr", '05' => "Mai", '06' => "Jui", '07' => "Jui", '08' => "Aoû", '09' => "Sep", '10' => "Oct", '11' => "Nov", '12' => "Déc"),
				array("J", "F", "M", "A", "M", "J", "J", "A", "S", "O", "N", "D")
				// array('01' => "J", '02' => "F", '03' => "M", '04' => "A", '05' => "M", '06' => "J", '07' => "J", '08' => "A", '09' => "S", '10' => "O", '11' => "N", '12' => "D")
			);
		}
		elseif ($isoLang == "en") {
			$months = array(
				array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"),
				// array('01' => "January", '02' => "February", '03' => "March", '04' => "April", '05' => "May", '06' => "June", '07' => "July", '08' => "August", '09' => "September", '10' => "October", '11' => "November", '12' => "December"),
				array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"),
				// array('01' => "January", '02' => "Feb", '03' => "Mar", '04' => "Apr", '05' => "May", '06' => "Jun", '07' => "Jul", '08' => "Aug", '09' => "Sep", '10' => "Oct", '11' => "Nov", '12' => "Dec"),
				array("J", "F", "M", "A", "M", "J", "J", "A", "S", "O", "N", "D")
				// array('01' => "J", '02' => "F", '03' => "M", '04' => "A", '05' => "M", '06' => "J", '07' => "J", '08' => "A", '09' => "S", '10' => "O", '11' => "N", '12' => "D")
			);
		}
		elseif ($isoLang == "de") {
			$months = array(
				array("Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember"),
				// array('01' => "Januar", '02' => "Februar", '03' => "März", '04' => "April", '05' => "Mai", '06' => "Juni", '07' => "Juli", '08' => "August", '09' => "September", '10' => "Oktober", '11' => "November", '12' => "Dezember"),
				array("Jan", "Feb", "Mrz", "Apr", "Mai", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Dez"),
				// array('01' => "Jan", '02' => "Feb", '03' => "Mär", '04' => "Apr", '05' => "Mai", '06' => "Jun", '07' => "Jul", '08' => "Aug", '09' => "Sep", '10' => "Okt", '11' => "Nov", '12' => "Dez"),
				array("J", "F", "M", "A", "M", "J", "J", "A", "S", "O", "N", "D")
				// array('01' => "J", '02' => "F", '03' => "M", '04' => "A", '05' => "M", '06' => "J", '07' => "J", '08' => "A", '09' => "S", '10' => "O", '11' => "N", '12' => "D")
			);
		}
		
		return $months[$key];
	}



}

?>