<?php

defined('_EXEC') or die;

class com_apps extends Controllers {
	
	public function app(): void {
		if( $this->session->readSession('user') === null ) {
			header('Location: /dashboards/dashboard');
			exit;
		}
	}
	
	public function get(string $trackFunction, string $trackView = ""): void {
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
		$personnalFolder = $customer['datas']['personnal_folder'];
		$data['old_path'] = _ROOTURL_ ."/uploads/datas/". $personnalFolder . $post['old_path'] ."/". $post['drag_files'];
		$data['new_path'] = _ROOTURL_ ."/uploads/datas/". $personnalFolder . $post['new_path'] ."/". $post['drag_files'];
		
		$drop = FileSystems::move($data['old_path'], $data['new_path'], $personnalFolder);
		
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
