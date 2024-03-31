<?php

defined('_EXEC') or die;

class Customers
{
	/**
	 * @param array $condition
	 * @param bool $current
	 * @return array|false
	 */
	public function getCustomers(array $condition = [], bool $current = false): array|false
	{
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
		
		if($current) {
			return current($getCustomers);
		} else {
			return $getCustomers;
		}
	}
	
	/**
	 * @param int $idCustomer
	 * @param array $condition
	 * @return array
	 */
	public function getCustomer(int $idCustomer, array $condition = []): array
	{
		return array(
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
	}
	
}

?>