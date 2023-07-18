<?php

class Controllers {
	
	// public $requests;
	// public $session;
	// public $config;
	public $templates;
	public $vars;
	
	// function __construct(object $requests, object $session, object $config/*, object $ajax*/) {
	function __construct() {
		// $this->requests = $requests;
		// $this->session = $session;
		// $this->config = $config;
		$this->vars = array(
			'ua' => $_SERVER['HTTP_USER_AGENT'] /* USER AGENT */
		);
		
		$this->templates("data");

	}
	
	public function templates(string $view): void {
		// extract($this->vars);
		// debug($this->vars);

		ob_start();
			require _ROOTURL_ ."/views/html/". $view .".php";
				$viewOut = ob_get_clean();
		
		// debug($viewOut);
		require _ROOTURL_ ."/views/index.php";
	}
	
	// public function globalVars(string|array $varsName, null|string|array $varValue = null ): void {

	// 	if( !is_array($varsName) ) {
	// 		$varsName = array($varsName => $varValue);
	// 		$this->vars = array_merge($this->vars, $varsName);
	// 	} else {
	// 		$this->vars = array_merge($this->vars, $varsName);
	// 	}
	// }
	
}

?>