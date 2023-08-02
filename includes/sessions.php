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
		if( isset($_SESSION[$key]) ) {
			return $_SESSION[$key];
		} else {
			return null;
		}
		
		return $sessions[$key];
	}
	
	public function editSession(string $key, string|array|object $valueChange, string $keyMerge = ""): ?array {
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
	
}

?>
