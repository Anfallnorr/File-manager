<?php

defined('_EXEC') or die;

class Langs {
	
	protected $config;
	public $lang;
	
	function __construct(object $config) {
		$this->config = $config;
		$this->lang = $config->default_lang;
	}
	
	function lang(string $needle, string $controller = "", bool $return = false): ?string {
		if( $controller == "" ) {
			$controller = "theme";
		}
		
		$iniFile = "/language/". $this->lang ."/". $this->lang .".". $controller .".ini";
		
		if( file_exists(_ROOTURL_ . $iniFile) ) {
			$get_translation = parse_ini_file(_ROOTURL_ . $iniFile, true, INI_SCANNER_NORMAL);
			
			if( array_key_exists($needle, $get_translation) ) {
				$needle = $get_translation[$needle];
			}
		}
		
		if( $return == true ) {
			return $needle;
		} else {
			echo $needle;
			return null;
		}
	}
	
}

?>
