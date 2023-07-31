<?php

class Customers/*  extends Models */ {
	
	// public $table = "customers";
	// public $primaryKey = "id";
	
	public function getCustomers(array $condition = [], bool $current = false) {
		$getCustomers = array(
			array(
				'id' => 1,
				'gender' => "hf",
				'name' => "John",
				'firstname' => "Doe",
				'active' => 1,
				'username' => "webmaster@js-info.fr",
				'last_connection' => "2023-07-30 14:26:25",
				'access' => 1,
				'avatar' => "/uploads/avatars/webmaster1.jpg",
				'main_address' => 38,
				'main_phone' => 56,
				'main_email' => 11,
				'lang_default' => "inherit",
				'theme_default' => "inherit",
				'home_default' => "/datas/data",
				'theme_bg' => "theme0",
				'loader' => "loader1",
				'hotkeys' => "0",
				'quick_access' => '[{"id":13,"quick_access":"\/customers\/appointment","short_label":"Rdv","label":"Mes rendez-vous","icon":"bx-right-arrow-alt"},{"id":46,"quick_access":"\/datas\/data","short_label":"Drive","label":"Mon drive","icon":"bx-folder"},{"id":47,"quick_access":"\/datas\/picture","short_label":"Images","label":"Mes images","icon":"bx-image"},{"id":48,"quick_access":"\/datas\/audio","short_label":"Audio","label":"Lecteur audio","icon":"bx-headphone"},{"id":83,"quick_access":"\/tools\/todolist","short_label":"To do","label":"Todo liste","icon":"bx-clipboard"}]',
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
			'username' => "webmaster@js-info.fr",
			'last_connection' => "2023-07-30 14:26:25",
			'access' => 1,
			'avatar' => "/uploads/avatars/webmaster1.jpg",
			'main_address' => 38,
			'main_phone' => 56,
			'main_email' => 11,
			'lang_default' => "inherit",
			'theme_default' => "inherit",
			'home_default' => "/datas/data",
			'theme_bg' => "theme0",
			'loader' => "loader1",
			'hotkeys' => "0",
			'quick_access' => '[{"id":13,"quick_access":"\/customers\/appointment","short_label":"Rdv","label":"Mes rendez-vous","icon":"bx-right-arrow-alt"},{"id":46,"quick_access":"\/datas\/data","short_label":"Drive","label":"Mon drive","icon":"bx-folder"},{"id":47,"quick_access":"\/datas\/picture","short_label":"Images","label":"Mes images","icon":"bx-image"},{"id":48,"quick_access":"\/datas\/audio","short_label":"Audio","label":"Lecteur audio","icon":"bx-headphone"},{"id":83,"quick_access":"\/tools\/todolist","short_label":"To do","label":"Todo liste","icon":"bx-clipboard"}]',
			'datas' => array(
				'personnal_folder' => "c4ca4238a0b923820dcc509a6f75849b-1"
			)
		);
		
		return $getCustomer;
	}
	
}

?>