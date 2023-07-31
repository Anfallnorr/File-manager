<?php

defined('_EXEC') or die;

class com_apps extends Controllers {
	
	// public $Access;
	public $Address;
	// public $Appointments;
	public $Appointmentsrequest;
	// public $Customers;
	public $Orders;
	public $Products;
	// public $Todos;
	// public $Todoschats;
	public $Webmailconnections;
	
	public function app(): void {
		if( $this->session->readSession('user') === null ) {
			header('Location: /dashboards/dashboard');
			exit;
		}
	}
	
	public function get(string $trackFunction, string $trackView = ""): void {
		// debug($trackFunction);
		// die;
		if( !empty($trackFunction) && !empty($trackView) && !empty($this->requests->post) ) {
			$this->{$trackFunction}($trackView, $this->requests->post);
		}
		elseif( !empty($trackFunction) && empty($trackView) && !empty($this->requests->post) ) {
			$this->{$trackFunction}($this->requests->post);
		}
		elseif( !empty($trackFunction) && empty($trackView) ) {
			$this->{$trackFunction}();
		}
	}
	
	public function set(string $trackFunction, string $trackView = ""): void {
		debug($trackFunction);
		// debug($trackView);
		// debug($this->requests->post);
		die;
		if( !empty($trackFunction) && !empty($trackView) && !empty($this->requests->post) ) {
			$this->{$trackFunction}($trackView, $this->requests->post);
		} 
		elseif( !empty($trackFunction) && empty($trackView) && !empty($this->requests->post) ) {
			$this->{$trackFunction}($this->requests->post);
		}
	}
	
	public function trackMenuToggle(object $post): void {
		if( $this->session->readSession('trackMenuToggle') === null ) {
			$this->session->writeSession('trackMenuToggle', array());
		}
		
		if( $post->hasToggle == "true" ) {
			$toggle = "not-toggled";
		} else {
			$toggle = "toggled";
		}
		
		$this->session->editSession('trackMenuToggle', array('menuToggle' => $toggle));		
		exit;
	}
	
	public function tracktabs(string $trackView, object $post): void {
		if( $this->session->readSession('trackTabs') === null ) {
			$this->session->writeSession('trackTabs', array());
		}
		
		if( !empty($post->accordion) ) {
			$this->session->editSession('trackTabs', array($post->accordion => $post->trackTab), $trackView);
		} else {
			$this->session->editSession('trackTabs', array($trackView => $post->trackTab));
		}
		
		exit;
	}
	
	public function trackCollapses(string $trackView, object $post): void {
		debug($post);
		die;
		if( $this->session->readSession('trackCollapses') === null ) {
			$this->session->writeSession('trackCollapses', array());
		}
		
		$this->session->editSession('trackCollapses', array($trackView => $post->trackCollapse));
		exit;
	}
	
	public function trackExpander(object $post): void {
		if( !empty($post->expandDatas) ) {			
			if( $post->expandDatas == "true" ) {
				$this->session->editSession('user', array('expander' => "true"), 'datas');
			} else {
				$this->session->editSession('user', array('expander' => "false"), 'datas');
			}
		}
		
		exit;
	}
	
	public function dataDragAndDrop(array|object $post): string {
		if( !is_array($post) ) {
			$post = get_object_vars($post);
		}
		
		$customer = $this->session->readSession('user');
		$personnal_folder = $customer['datas']['personnal_folder'];
		$data['old_path'] = _ROOTURL_ ."/uploads/datas/". $personnal_folder . $post['old_path'] ."/". $post['drag_files'];
		$data['new_path'] = _ROOTURL_ ."/uploads/datas/". $personnal_folder . $post['new_path'] ."/". $post['drag_files'];
		
		$drop = FileSystems::move($data['old_path'], $data['new_path'], $personnal_folder);
		
		$return = array_merge(
			array('notif' => $drop),
			array('data' => array_merge($post, array('type' => $drop[2])))
		);

		echo json_encode($return);
		exit;
		die;
	}
	
}

?>