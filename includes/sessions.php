<?php

defined('_EXEC') or die;

class Sessions {
	
	function __construct() {
		session_save_path(_ROOTURL_ . "/var/sessions");
		session_start();
	}
	
	public function setNotifications($notifications, $type = "") {
		if( $type != "" ) {
			$notification = array(
				'value' => $notifications,
				'type' => $type,
				'icon' => ($type === "success") ? "bx bxs-check-circle" : "bx bxs-info-circle"
			);
		} else {
			$notification = array(
				'value' => $notifications,
				'type' => "default",
				'icon' => "bx bxs-message-square-x"
			);
		}
		
		$_SESSION['notifications'] = $notification;
	}
	
	public function getNotifications() {
		if( !empty($_SESSION['notifications']) ) {
			$notifications = $_SESSION['notifications'];
			unset($_SESSION['notifications']);
		} else {
			$notifications = '';
		}
		
		return $notifications;
	}
	
	public function writeSession(string $key, string|array $value): string|array {
		if( is_array($value) && !empty($value[0]) ) {
			$sessionUser = $_SESSION[$key] = $value[0];
		} else {
			$sessionUser = $_SESSION[$key] = $value;
		}
		
		return $sessionUser;
	}
	
	public function readSession(string $key = ""): null|string|array {
		// if( isset($_SESSION[$key]) ) {
			// return $_SESSION[$key];
		// } else {
			// return null;
		// }
		$sessions = array(
			'user' => array(
				'id' => 1,
				'gender' => "hf",
				'name' => "John",
				'firstname' => "Doe",
				'active' => 1,
				'username' => "webmaster@js-info.fr",
				'reset_password' => 0,
				'reset_password_token' => "",
				'last_connection' => "2023-07-30 08:26:39",
				'access' => 1,
				'avatar' => "/uploads/avatars/webmaster1.jpg",
				'main_address' => 38,
				'main_phone' => 56,
				'main_email' => 11,
				'session' => "7439a6ec9dc8e77259d799bd025268a7",
				'lang_default' => "inherit",
				'theme_default' => "inherit",
				'home_default' => "/datas/data",
				'theme_bg' => "theme0",
				'loader' => "loader1",
				'hotkeys' => 0,
				'quick_access' => '[{"id":13,"quick_access":"\/customers\/appointment","short_label":"Rdv","label":"Mes rendez-vous","icon":"bx-right-arrow-alt"},{"id":46,"quick_access":"\/datas\/data","short_label":"Drive","label":"Mon drive","icon":"bx-folder"},{"id":47,"quick_access":"\/datas\/picture","short_label":"Images","label":"Mes images","icon":"bx-image"},{"id":48,"quick_access":"\/datas\/audio","short_label":"Audio","label":"Lecteur audio","icon":"bx-headphone"},{"id":83,"quick_access":"\/tools\/todolist","short_label":"To do","label":"Todo liste","icon":"bx-clipboard"}]',
				'datas' => array(
					'personnal_folder' => "c4ca4238a0b923820dcc509a6f75849b-1",
				),
				'log' => "login"
			)
		);
		return $sessions[$key];
	}
	
	public function editSession(string $key, string|array|object $valueChange, string $keyMerge = ""): ?array {
		// $this->session->editSession("user", array("quick_access" => json_encode($post)), ?$string);
		// $this->session->editSession("user", array('path' => $this->requests->params), "datas");
		
		if( !is_array($valueChange) ) {
			$valueChange = get_object_vars($valueChange);
		}
		
		if( isset($_SESSION[$key]) ) {
			if( $keyMerge === "" ) {
				foreach($valueChange as $change => $value) {
					if( $change !== "id" ) {
						$_SESSION[$key][$change] = $value;
					}
				}
			} else {
				foreach($valueChange as $change => $value) {
					$_SESSION[$key][$keyMerge][$change] = $value;
				}
			}
			return $_SESSION[$key];
		} else {
			return null;
		}
	}
	
	public function writeCookie(string $key, string $value, int $cookies_times): string|array {
		$coockieUser = $_COOKIE[$key] = $value;
		
		return $coockieUser;
	}
	
	public function readCookie(string $key): null|string|array {
		if( isset($_COOKIE[$key]) ) {
			return $_COOKIE[$key];
		} else {
			return null;
		}
	}
	
	public function deleteCookie(string $key): bool {
		unset($_COOKIE[$key]);
		
		return true;
	}
	
	public function deleteSession(string $key, string|array $sessionKeys = []): bool {
		if( is_array($sessionKeys) && !empty($sessionKeys) ) {
			foreach($sessionKeys as $sessionKey) {
				unset($_SESSION[$key][$sessionKey]);
			}
		} 
		elseif( is_string($sessionKeys) && !empty($sessionKeys) ) {
			unset($_SESSION[$key][$sessionKeys]);
		} 
		else {
			unset($_SESSION[$key]);
		}
		
		return true;
	}
	
	public function isLog(): bool {
		if( isset($_SESSION['user']) ) {
			return true;
		} else {
			return false;
		}
	}
	
	public function isLock(): string {
		if( isset($_SESSION['session']) && $_SESSION['session'] === "active" ) {
			
			return "active";
		} else {
			
			return "inactive";
		}
	}
	
}

?>