<?php

defined('_EXEC') or die;

class Dispatchers
{
	/**
	 * @var \Sessions
	 */
	public Sessions $session;
	/**
	 * @var \Requests
	 */
	public Requests $requests;
	/**
	 * @var \Config
	 */
	public Config $config;
	
	function __construct()
    {
		$this->session = new Sessions();
		$this->requests = new Requests();
		$this->config =  new Config();
		$theme = $this->config->theme;
		
		Router::parseUrl($this->requests);
		
		$views = $this->requests->view;
		$params = $this->requests->params;
		$controllers = $this->loader($this->requests->controller, $theme);
		
		$getClassMethods = get_class_methods($controllers);
		$getClassMethodsControllers = get_class_methods('Controllers');
		
		$arrayDiffResult = array_diff($getClassMethods, $getClassMethodsControllers);
		
		if (!in_array($views, $arrayDiffResult, true)) {
			$this->error404("La méthode ". $views ." n'existe pas dans le controller ". $this->requests->controller);
		} else {
			if (is_array($params)) {
				call_user_func_array(array($controllers, $views), $params);
			} else {
				call_user_func_array(array($controllers, $views), array($params));
			}
		}
		
		$controllers->templates($views);
	}
	
	/**
	 * @param string $loader
	 * @param string $theme
	 * @return mixed|void
	 */
	public function loader(string $loader, string $theme)
    {
		$comLoader = "com_". $loader;
		
		if (file_exists(_ROOTURL_ ."/templates/systems/html/". $comLoader .".php")) {
			require _ROOTURL_ ."/templates/systems/html/". $comLoader .".php";
			return new $comLoader($this->requests, $this->session, $this->config);
		} else {
			$this->error404("Le controller ". $comLoader ." n'existe pas");
		}
	}
	
	/**
	 * @param $errorMessage
	 * @return void
	 */
	public function error404($errorMessage): void
	{
		die($errorMessage);
	}

}

?>
