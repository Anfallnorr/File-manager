<?php

defined('_EXEC') or die;

class Controllers
{
	/**
	 * @var object
	 */
	public object $requests;
	/**
	 * @var object
	 */
	public object $session;
	/**
	 * @var object
	 */
	public object $config;
	/**
	 * @var \Langs
	 */
	public Langs $langs;
	/**
	 * @var string
	 */
	public string $theme;
	/**
	 * @var string
	 */
	public string $default_lang;
	/**
	 * @var
	 */
	public $notifications;
	/**
	 * @var
	 */
	public $Customers;
	/**
	 * @var
	 */
	public $customer;
	/**
	 * @var
	 */
	public $Params;
	/**
	 * @var
	 */
	public $params;
	/**
	 * @var string|mixed
	 */
	public string $personnalFolder;
	/**
	 * @var string
	 */
	public string $personnalRoot;
	/**
	 * @var string
	 */
	public string $personnalThumbRoot;
	/**
	 * @var string
	 */
	public string $tmpRoot;
	
	/**
	 * @var array
	 */
	private array $vars = [];
	
	/**
	 * @param object $requests
	 * @param object $session
	 * @param object $config
	 */
	function __construct(object $requests, object $session, object $config)
	{
		$this->requests = $requests;
		$this->session = $session;
		$this->config = $config;
		$this->theme = $this->config->theme;
		$this->default_lang = $this->config->default_lang;
		$this->notifications = $this->session->getNotifications();
		
		if($this->session->readSession('user') !== null) {
			$this->customer = $this->session->readSession('user');
			
			if ($this->customer['datas']['personnal_folder'] != session_id()) {
				$this->customer['datas']['personnal_folder'] = session_id();
				$this->session->writeSession('user', $this->customer);
			}
		} else {
			if (!class_exists('Customers')) {
				$this->loadModels('Customers');
			}
			$this->customer = $this->Customers->getCustomer(1);
			$this->customer['datas']['personnal_folder'] = session_id();
			
			$this->session->writeSession('user', $this->customer);
		}
		
		if (!class_exists('Params')) {
			$this->loadModels('Params');
		}
		$this->params = $this->Params->getParams();
		
		$this->personnalFolder = $this->session->readSession('user')['datas']['personnal_folder'];
		$this->personnalRoot = _ROOTURL_ ."/uploads/datas/". $this->personnalFolder;
		$this->personnalThumbRoot = $this->personnalRoot ."/thumbnails";
		$this->tmpRoot = _ROOTURL_ ."/uploads/tmp/";
		
		$this->langs = new Langs($this->config);
		
		$this->globalVars(
			array(
				'params' => $this->params,
				'config' => $this->config,
				'customer' => $this->customer,
				'theme' => $this->theme,
				'langs' => $this->langs,
				'lang' => substr($this->langs->lang, 0, 2)
			)
		);
	}
	
	/**
	 * @param string $loadModels
	 * @return void
	 */
	public function loadModels(string $loadModels): void
	{
		if (file_exists(_ROOTURL_ ."/includes/models/". strtolower($loadModels) .".php")) {
			if (!isset($this->$loadModels)) {
				require _ROOTURL_ ."/includes/models/". strtolower($loadModels) .".php";
				$this->$loadModels = new $loadModels();
			}
		}
	}
	
	/**
	 * @param string $view
	 * @return void
	 */
	public function templates(string $view): void
	{
		$controller = $this->requests->controller;
		extract($this->vars);
		
		if (file_exists(_ROOTURL_ ."/templates/". $this->theme ."/html/". $controller ."/views/". $view .".php")) {
			ob_start();
			require _ROOTURL_ ."/templates/". $this->theme ."/html/". $controller ."/views/". $view .".php";
			$view_out = ob_get_clean();
		} else {
			$this->error404Controller("La vue ". $view ." n'existe pas dans le controller ". $controller);
		}
		
		require _ROOTURL_ ."/templates/". $this->theme ."/index.php";
	}
	
	/**
	 * @param $errorMessage
	 * @return void
	 */
	public function error404Controller($errorMessage): void
	{
		die($errorMessage);
	}
	
	/**
	 * @param string|array $varsName
	 * @param string|array|null $varValue
	 * @return void
	 */
	public function globalVars(string|array $varsName, null|string|array $varValue = null): void
	{
		if (!is_array($varsName)) {
			$varsName = array($varsName => $varValue);
		}
		
		$this->vars = array_merge($this->vars, $varsName);
	}
	
}

?>