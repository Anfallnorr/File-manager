<?php

defined('_EXEC') or die;

class Requests
{
	public $get;
	public $post;
	public $files;
	public $path;

	public $controller;
	public $view;
	public $params;
	
	function __construct()
    {
		$path = $_SERVER['ORIG_PATH_INFO'];
		
		$get = new stdClass();
		$post = new stdClass();
		$files = new stdClass();
		
		if (!empty($_GET)) {
			foreach ($_GET as $key => $getValue) {
				$get->$key = $getValue;
			}
			$this->get = $get;
		}
		if (!empty($_POST)) {
			foreach ($_POST as $key => $postValue) {
				$post->$key = $postValue;
			}
			$this->post = $post;
		}
		if (!empty($_FILES)) {
			foreach ($_FILES as $key => $filesValue) {
				$files->$key = $filesValue;
			}
			$this->files = $files;
		}
		
		$this->path = $path;
	}
    
}

?>
