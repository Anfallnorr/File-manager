<?php

defined('_EXEC') or die;

class Router {
	
	static function parseUrl($requests) {
		$parsePath = substr($requests->path, 1);
		$parsePath = explode("/", $parsePath);
		
		$requests->seos = array(
			array(
				'id' => 1,
				'id_page_view' => 1,
				'title' => "authentification",
				'description' => "Connexion",
				'robots' => "index,follow",
			),
			array(
				'id' => 25,
				'id_page_view' => 46,
				'title' => "Mes documents",
				'description' => "Mes documents",
				'robots' => "noindex,nofollow",
			),
			array(
				'id' => 56,
				'id_page_view' => 89,
				'title' => "Application",
				'description' => "App",
				'robots' => "noindex,nofollow",
			),
			array(
				'id' => 57,
				'id_page_view' => 90,
				'title' => "Get",
				'description' => "Getter",
				'robots' => "noindex,nofollow",
			)
		);
		
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
		
		$requests->pages = array(
			'controllers' => array(
				array(
					'id' => 1,
					'id_page_view' => "1,2,3,4,5,6,74",
					'id_page_function' => "1,2",
					'position' => "1",
					'name' => "authentications",
					'label' => "Authentifications",
					'icon' => "bx-right-arrow-alt",
					'access' => 5,
					'active' => 1
				),
				array(
					'id' => 8,
					'id_page_view' => "46,47,48,49,50,51,52,53,54,55,56,57,58,59,86",
					'id_page_function' => "8,9,10,11,12,13,14,15,16",
					'position' => "8",
					'name' => "datas",
					'label' => "Drive",
					'icon' => "bx-cloud",
					'access' => 4,
					'active' => 1
				),
				array(
					'id' => 15,
					'id_page_view' => "89,90,91",
					'id_page_function' => "",
					'position' => "14",
					'name' => "apps",
					'label' => "Apps",
					'icon' => "bx-right-arrow-alt",
					'access' => 5,
					'active' => 1
				)
			),
			'views' => array(
				array(
					'id' => 1,
					'id_page_controller' => 1,
					'position' => "0",
					'name' => "authentication",
					'label' => "Authentification",
					'short_label' => "",
					'icon' => "bx-right-arrow-alt",
					'is_function' => 0,
					'access' => 5,
					'active' => 1,
					'params' => ""
				),
				array(
					'id' => 46,
					'id_page_controller' => 8,
					'position' => "0",
					'name' => "data",
					'label' => "Mon drive",
					'short_label' => "Drive",
					'icon' => "bx-folder",
					'is_function' => 0,
					'access' => 4,
					'active' => 1,
					'params' => ""
				),
				array(
					'id' => 89,
					'id_page_controller' => 15,
					'position' => "0",
					'name' => "app",
					'label' => "app",
					'short_label' => "app",
					'icon' => "bx-right-arrow-alt",
					'is_function' => 0,
					'access' => 5,
					'active' => 1,
					'params' => ""
				),
				array(
					'id' => 90,
					'id_page_controller' => 15,
					'position' => "0",
					'name' => "get",
					'label' => "get",
					'short_label' => "get",
					'icon' => "bx-right-arrow-alt",
					'is_function' => 0,
					'access' => 5,
					'active' => 1,
					'params' => ""
				)
			)
		);
	}
	
}

?>
