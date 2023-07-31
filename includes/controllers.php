<?php

defined('_EXEC') or die;

class Controllers {
	
	public $BellNotifications;
	public $mails;
	public $langs;
	public $notifications;
	public $Customers;
	public $Datasshare;
	public $Params;
	public $Statsnav;
	public $Statslog;
	public $Statsmail;
	
	public $requests;
	public $session;
	public $config;
	public $params;
	public $customer;
	
	public $forms;
	private $vars = [];
	public $data = [];
	public $theme;
	public $default_lang;
	public $message;
	public $locationIp;
	
	function __construct(object $requests, object $session, object $config) {
		$this->requests = $requests;
		$this->session = $session;
		$this->config = $config;
		$this->notifications = $this->session->getNotifications();
		$this->theme = $this->config->theme;
		$this->default_lang = $this->config->default_lang;
		
		$this->customer = $this->session->readSession('user');
		
		if( $this->customer !== null ) {
			if( $this->customer['lang_default'] != "inherit" ) {
				$this->getDefaultLang($this->customer['lang_default']);
			}
			if( $this->customer['theme_default'] != "inherit" ) {
				$this->theme = $this->customer['theme_default'];
			}
			
			$checkNotifications = array();
		} else {
			$checkNotifications = array();
		}
		
		// $this->getClassesByTheme($this->theme);
		
		if( !class_exists('Params') ) {
			$this->loadModels('Params');
		}
		$this->params = $this->Params->getParams();
		
		$this->requests->pages['controllers'] = $this->excludeControllers($this->requests->pages['controllers'], $this->params['menu_exclude']);
		$this->requests->pages['views'] = $this->excludeViews($this->requests->pages['views'], $this->params['menu_exclude']);
		
		$exclude_pages['controllers'] = $this->requests->pages['controllers']['exclude'];
		$exclude_pages['views'] = $this->requests->pages['views']['exclude'];
		
		unset($this->requests->pages['controllers']['exclude'], $this->requests->pages['views']['exclude']);
		
		$page_controllers = $this->requests->pages['controllers'];
		$page_views = $this->requests->pages['views'];
			
		$device = getStyleDevice($_SERVER['HTTP_USER_AGENT']);
		
		$this->langs = "fr-FR";
		
		$this->globalVars(
			array(
				'params' => $this->params, /* SITE PARAMS */
				'config' => $this->config, /* SITE CONFIG */
				'langs' => $this->langs, /* SITE LANGUAGE */
				'lang' => substr($this->langs, 0, 2), /* SITE LANGUAGE */
				'customer' => $this->customer, /* CUSTOMER */ // 'customer' => $customer, /* CUSTOMER */
				'this_exclude_controller' => in_arrays($this->requests->controller, $exclude_pages['controllers']), /* ACTUAL EXCLUDE CONTROLLER */
				'this_exclude_views' => in_arrays($this->requests->view, $exclude_pages['views']), /* ACTUAL EXCLUDE VIEW */
				'this_controller' => in_arrays($this->requests->controller, $page_controllers), /* ACTUAL CONTROLLER */
				'this_view' => in_arrays($this->requests->view, $page_views), /* ACTUAL VIEW */
				'this_seo' => in_arrays(in_arrays($this->requests->view, $page_views), $this->requests->seos, "id", "id_page_view"), /* ACTUAL SEO */
				'css_files' => "/templates/vivo/html/". $this->requests->controller ."/assets/css/". $this->requests->view .".css",
				'js_files' => "/templates/vivo/html/". $this->requests->controller ."/assets/js/". $this->requests->view .".js",
				'pages' => ( !empty($this->requests->pages) ) ? $this->requests->pages : array(), /* PAGES SIDEBAR */
				'device' => $device, /* STYLE DEVICE */
				'ua' => $_SERVER['HTTP_USER_AGENT'] /* USER AGENT */
			)
		);
	}
	
	public function loadModels(string $loadModels): void {
		if( file_exists(_ROOTURL_ ."/includes/models/". strtolower($loadModels) .".php") ) {
			if( !isset($this->$loadModels) ) {
				require _ROOTURL_ ."/includes/models/". strtolower($loadModels) .".php";
				$this->$loadModels = new $loadModels();
			}
		}
	}
	
	public function templates(string $view): void {
		$controller = $this->requests->controller;
		extract($this->vars);
		
		if( file_exists(_ROOTURL_ ."/templates/html/". $controller ."/views/". $view .".php") ) {
			ob_start();
				require _ROOTURL_ ."/templates/html/". $controller ."/views/". $view .".php";
					$view_out = ob_get_clean();
		} else {
			$this->error404Controller("La vue ". $view ." n'existe pas dans le controller ". $controller);
		}
		
		require _ROOTURL_ ."/templates/index.php";
	}
	
	public function error404Controller($errorMessage): void {
		die($errorMessage);
		$this->message = $errorMessage;
		$this->globalVars(array('message' => $errorMessage));
		
		$this->requests->controller = "errors";
		$this->requests->view = "error404";
		$this->templates('error404');
	}
	
	public function globalVars(string|array $varsName, null|string|array $varValue = null ): void {
		if( !is_array($varsName) ) {
			$varsName = array($varsName => $varValue);
			$this->vars = array_merge($this->vars, $varsName);
		} else {
			$this->vars = array_merge($this->vars, $varsName);
		}
	}
	
	public function getDefaultLang(string $userLang = ""): void {
		if( !empty($userLang) ) {
			$this->default_lang = $userLang;
		} else {
			$countryCode = $this->locationIp['location']['country_code'];
			$countryCode = in_array($countryCode, array("UK", "GB")) ? "en-EN" : strtolower($countryCode) ."-". $countryCode;
			
			$this->default_lang = $countryCode;
		}
	}
	
	public function excludeControllers(array $pagesControllers, string $exclude = ""):? array {
		/* TRIAGE DU CONTROLLER */
		$exclude = explode(',', $exclude);
		$controllers['exclude'] = array();
		
		foreach( $pagesControllers as $pages ) {
			if( !in_array($pages['name'], $exclude) ) {
				$pages['id_page_view'] = explode(',', $pages['id_page_view']);
				$controllers[] = $pages;
			} else {
				$controllers['exclude'][] = $pages;
			}
		}
		
		return $controllers;
	}
	
	public function excludeViews(array $pagesViews, string $exclude = ""):? array {
		// /* TRIAGE DE LA VUE */
		$exclude = explode(',', $exclude);
		$views['exclude'] = array();
		
		foreach( $pagesViews as $pages ) {
			if( !in_array($pages['name'], $exclude) ) {
				$views[] = $pages;
			} else {
				$views['exclude'][] = $pages;
			}
		}
		
		return $views;
	}
	
}

?>