<?php

class Customers {
	
	public function getCustomers(array $condition = [], bool $current = false) {
		$getCustomers = array(
			array(
				'id' => 1,
				'gender' => "hf",
				'name' => "John",
				'firstname' => "Doe",
				'active' => 1,
				'username' => "demo@demo.fr",
				'access' => 1,
				'theme_bg' => "theme0",
				'hotkeys' => "0"
			)
		);
		
		if( $current == true ) {
			return current($getCustomers);
		} else {
			return $getCustomers;
		}
	}
	
	public function getCustomer(int $idCustomer, array $condition = []) {
		$getCustomer = array(
			'id' => 1,
			'gender' => "hf",
			'name' => "John",
			'firstname' => "Doe",
			'active' => 1,
			'username' => "demo@demo.fr",
			'access' => 1,
			'theme_bg' => "theme0",
			'hotkeys' => "0",
			'datas' => array(
				'personnal_folder' => ""
			)
		);
		
		return $getCustomer;
	}
	
}

?>
