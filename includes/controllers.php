<?php

defined('_EXEC') or die;

class Controllers {
	
	public $notifications;
	public $Customers;
	public $Params;
	
	public $requests;
	public $session;
	public $config;
	public $params;
	public $customer;
	
	private $vars = [];
	
	function __construct(object $requests, object $session, object $config) {
		$this->requests = $requests;
		$this->session = $session;
		$this->config = $config;
		$this->notifications = $this->session->getNotifications();
		
		$this->customer = $this->session->readSession('user');
		
		if( !class_exists('Params') ) {
			$this->loadModels('Params');
		}
		$this->params = $this->Params->getParams();
		
		$this->globalVars(
			array(
				'params' => $this->params,
				'config' => $this->config,
				'customer' => $this->customer,
				'lang' => "fr"
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
	}
	
	public function globalVars(string|array $varsName, null|string|array $varValue = null ): void {
		if( !is_array($varsName) ) {
			$varsName = array($varsName => $varValue);
			$this->vars = array_merge($this->vars, $varsName);
		} else {
			$this->vars = array_merge($this->vars, $varsName);
		}
	}
	
}

?>
