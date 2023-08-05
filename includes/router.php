<?php

defined('_EXEC') or die;

class Router {
	
	static function parseUrl($requests) {
		$parsePath = substr($requests->path, 1);
		$parsePath = explode("/", $parsePath);
		
		if( !empty($parsePath[0]) && !empty($parsePath[1]) ) {
			$requests->controller = $parsePath[0];
			$requests->view = $parsePath[1];
			
			$params = array_slice($parsePath, 2);
			$requests->params = $params;
		} else {
			$requests->controller = "datas";
			$requests->view = "data";
			$requests->params = "";
		}
	}
	
}

?>
