<?php

defined('_EXEC') or die;

class Models {
	
    public $config;
    public $dbh;
	
	function __construct() {
		$this->config = new Config();
		$this->table = $this->config->dbprefix . $this->table;
		
		try {
			$this->dbh = new PDO(
				"mysql:dbname=". $this->config->db .";host=". $this->config->host, 
				$this->config->user, 
				$this->config->password, 
				array(
					PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES \"UTF8\""
				)
			);
		} catch (PDOException $e) {
			echo "Connexion échouée : " . $e->getMessage();
		}
	}
	
	public function __destruct() {
		$sth = null;
		$this->dbh = null;
	}
	
	public function dbhErrorInfo(array $error): array {
        $info_error = "sqlstate : ". $error[0] ."<br />";
        $info_error .= $error[1] ."<br />";
        $info_error .= "message : ". $error[2];
		return $error;
	}
	
	public function getHashPwd(string $string): string {
		$pwd_hashed = md5($string);
		$pwd_hashed = crypt($pwd_hashed, $this->config->secret);
		
        return "$2y$10$". md5($this->config->secret) . $pwd_hashed ."$9W$1z$";
	}
	
	public function selects(array $condition = [], bool $fetch = true): array {
		$where = [];
		
		if( is_array($condition) || is_object($condition) ) {
			foreach($condition as $key => $value) {
				if( is_int($value) ) {
					$where[] = $key ." = ". $value;
				} else {
					$where[] = $key .' = "'. $value .'"';
				}
			}
		}
		$where = implode(" AND ", $where);
		
		if( empty($condition) ) {
			$sth = $this->dbh->prepare("SELECT * FROM ". $this->table);
		} else {
			$sth = $this->dbh->prepare("SELECT * FROM ". $this->table ." WHERE ". $where);
		}
		if( !$sth ) {
			debug($sth->errorInfo());
		}
		
		$sth->execute();
		
		if( $fetch !== true ) {
			if( !$selects = $sth->fetch(PDO::FETCH_ASSOC) ) {
				$selects = array();
			}
		} else {
			$selects = $sth->fetchAll(PDO::FETCH_ASSOC);
		}
		
		return $selects;
	}
	
	public function select($condition) {
		$select = $this->selects($condition, false);
		
		return $select;
	}
	
	public function selectsOrder(array $condition): array {
		$order = [];
		
		if( is_array($condition) || is_object($condition) ) {
			foreach($condition as $key => $value) {
				$order[] = $key ." = ". $value;
			}
		}
		
		$order = implode(" AND ", $order);
		
		$sth = $this->dbh->prepare("SELECT * FROM ". $this->table ." ORDER BY ". $condition['column'] ." ". $condition['order']);
		
		if( !$sth ) {
			debug($sth->errorInfo());
		}
		
		$sth->execute();
		$selects = $sth->fetchAll(PDO::FETCH_ASSOC);
		
		return $selects;
	}
	
	public function selectsJoin(
		array $condition, 
		string $select = "*", 
		string $from = "", 
		string $join = "", 
		array $joins = [], 
		string $where = "", 
		string $groups = "",
		string $limit = "",
		string $orders = ""
	): array {
		if( is_array($condition) || is_object($condition) ) {
			foreach($condition as $key => $value) {
				if( $key === "select" ) {
					$selects = $value;
				}
				elseif( $key === "from" ) {
					$from = ", ". $value;
				}
				elseif( $key === "where" ) {
					$wheres = $value;
				}
				elseif( $key === "or" ) {
					foreach($condition[$key] as $v) {
						$ors[] = $v;
					}
				}
				elseif( $key === "and" ) {
					foreach($condition[$key] as $v) {
						$ands[] = $v;
					}
				}
				elseif( $key === "inner_join" ) {
					$joins[] = " INNER JOIN ". $condition[$key]['table'] ." ON ". $condition[$key]['table'] .".". $condition[$key]['on'][0] ." = ". $this->table .".". $condition[$key]['on'][1];
				}
				elseif( $key === "left_join" ) {
					if( !empty($condition[$key]['count']) ) {
						for($i = 0; $i < $condition[$key]['count']; $i++) {
							$joins[] = " LEFT JOIN ". $condition[$key][$i]['table'] ." ON ". $condition[$key][$i]['table'] .".". $condition[$key][$i]['on'][0] ." = ". $this->table .".". $condition[$key][$i]['on'][1];
						}
					} else {
						$joins[] = " LEFT JOIN ". $condition[$key]['table'] ." ON ". $condition[$key]['table'] .".". $condition[$key]['on'][0] ." = ". $this->table .".". $condition[$key]['on'][1];
					}
				}
				elseif( $key === "right_join" ) {
					$joins[] = " RIGHT JOIN ". $condition[$key]['table'] ." ON ". $condition[$key]['table'] .".". $condition[$key]['on'][0] ." = ". $this->table .".". $condition[$key]['on'][1];
				}
				elseif( $key === "full_join" ) {
					$joins[] = " FULL JOIN ". $condition[$key]['table'] ." ON ". $condition[$key]['table'] .".". $condition[$key]['on'][0] ." = ". $this->table .".". $condition[$key]['on'][1];
				}
				elseif( $key === "natural_join" ) {
					$joins[] = " NATURAL JOIN ". $condition[$key]['table'] ." ON ". $condition[$key]['table'] .".". $condition[$key]['on'][0] ." = ". $this->table .".". $condition[$key]['on'][1];
				}
				elseif( $key === "group" ) {
					$groups = " GROUP BY ". $condition[$key];
				}
				elseif( $key === "limit" ) {
					$limit = " LIMIT ". $condition[$key];
				}
				elseif( $key === "order" ) {
					$orders = " ORDER BY ". $condition[$key];
				}
			}
		}
		
		if( isset($selects[0]) ) {
			$select = implode(", ", $selects);
		}
		
		foreach($joins as $j) {
			$join .= $j;
		}
		
		if( isset($wheres[0]) ) {
			$where = " WHERE ";
			$where .= implode(" AND ", $wheres);
		}
		
		if( isset($ors[0]) ) {
			$where = " WHERE ";
			$where .= implode(" OR ", $ors);
		}
		
		if( isset($ands[0]) ) {
			$where = " WHERE ";
			$where .= implode(" AND ", $ands);
		}
		
		$sth = $this->dbh->prepare("SELECT ". $select ." FROM ". $this->table . $from . $join . $where . $groups . $limit . $orders);
		
		if( !$sth ) {
			debug($sth->errorInfo());
		}
		
		$sth->execute();
		$selects = $sth->fetchAll(PDO::FETCH_ASSOC);
		
		return $selects;
	}
	
	public function save(array|object $updateData) {
		if( !is_array($updateData) ) {
			$updateData = get_object_vars($updateData);
		}
		
		if( !empty($updateData[$this->primaryKey]) || !empty($updateData[0][$this->primaryKey]) ) {
			/* ********** UPDATE ********** */
			if( !empty($updateData[0][$this->primaryKey]) ) {
				
				foreach($updateData as $k => $val) {
					$i = 1;
					
					foreach($val as $key => $value) {
						if( $key == $this->primaryKey ) {
							$idValue[] = " WHERE ". $key ." = ". $value;
						} else {
							if( count($updateData[$k]) > 2 ) {
								if( empty($setValue[$k]) ) {
									$setValue[$k] = ' SET ';
								}
								if( $key == "password" ) {
									$value = $this->getHashPwd($value);
								}
								if( count($updateData[$k]) === ++$i ) {
										$setValue[$k] .= $key .' = "'. $value .'"';
								} else {
									$setValue[$k] .= $key .' = "'. $value .'", ';
								}
							} else {
								$setValue[] = ' SET '. $key .' = "'. $value .'"';
							}
						}
					}
				}
				
				if( count($idValue) === count($setValue) ) {
					for($i = 0; $i < count($idValue); $i++) {
						$updateValue[] = "UPDATE ". $this->table . $setValue[$i] . $idValue[$i] .";";
					}
				}
				
				$updateValue = implode(' ', $updateValue);
				
				$sth = $this->dbh->prepare($updateValue);
			} else {
				$idValue = [];
				$setValue = [];
				
				foreach($updateData as $key => $value) {
					if( $key == $this->primaryKey ) {
						$idValue[] = $key ." = ". $value;
					} else {
						if( $key == "password" ) {
							$setValue[] = $key .' = "'. $this->getHashPwd($value) .'"';
						} else {
							if( $value === null ) {
								$setValue[] = $key .' = NULL';
							} else {
								if( gettype($value) == "integer" ) {
									$setValue[] = $key .' = '. intval($value);
								} else {
									$setValue[] = $key .' = "'. addslashes($value) .'"';
								}
							}
						}
					}
				}
				
				$idValue = implode(", ", $idValue);
				$setValue = implode(", ", $setValue);
				
				$sth = $this->dbh->prepare("UPDATE ". $this->table ." SET ". $setValue ." WHERE ". $idValue);
			}
			
			$sth->execute();
			
			return true;
			
		} else {
			/* ********** INSERT ********** */
			if( !empty($updateData[0]) ) {
				$insertValues = "";
				
				foreach($updateData as $key => $value) {
					foreach($value as $k => $v) {
						$insertInto[] = $k;
						if( $k == "password" ) {
							$insertValue[$key][] = '"'. $this->getHashPwd($v) .'"';
						} else {
							$insertValue[$key][] = '"'. addslashes($v) .'"';

						}
					}
				}
				
				for($i = 0; $i < count($insertValue); $i++) {
					$j = 0;
					$insertValues .= " (";
					
					foreach($insertValue[$i] as $k => $v) {
						if( count($insertValue[$i]) === ++$j ) {
							$insertValues .= $insertValue[$i][$k];
						} else {
							$insertValues .= ''. $insertValue[$i][$k] .', ';
						}
					}
					
					if( $i === (count($insertValue) - 1) ) {
						$insertValues .= ") ";
					} else {
						$insertValues .= "), ";
					}
				}
				
				$insertInto = array_unique($insertInto);
				$insertInto = implode(", ", $insertInto);
				
				$sth = $this->dbh->prepare("INSERT INTO ". $this->table ." (". $insertInto .") VALUES ". $insertValues ."");
			} else {
				foreach($updateData as $key => $value) {
					$insertInto[] = $key;
					if( $key == "password" ) {
						$insertValue[] = '"'. $this->getHashPwd($value) .'"';
					} else {
						if( $value === null ) {
							$insertValue[] = 'NULL';
						} elseif( is_int($value) ) {
							$insertValue[] = $value;
						} else {
							$insertValue[] = '"'. addslashes($value) .'"';
						}
					}
				}
				
				$insertInto = implode(", ", $insertInto);
				$insertValue = implode(", ", $insertValue);
				
				$sth = $this->dbh->prepare("INSERT INTO ". $this->table ."(". $insertInto .") VALUES (". $insertValue .")");
			}
			
			if( !$sth ) {
				debug($sth->errorInfo());
				return false;
			}
			
			$sth->execute();
			$lastInsertId = $this->dbh->lastInsertId();
			
			return $lastInsertId;
		}
	}
	
	public function userQuickAccess(array|object $values) {
		$primaryKey = $this->primaryKey;
		
		if( !is_array($values) ) {
			$values = get_object_vars($values);
		}
		
		if( !empty($values[$this->primaryKey]) ) {
			foreach($values as $key => $value) {
				if( $key == $this->primaryKey ) {
					$idParam[] = $key ." = ". $value;
				} else {
					$setParam[$key] = $value;
				}
			}
			
			$setParam = (!empty($setParam)) ? json_encode($setParam) : NULL;
			$idParam = implode(', ', $idParam);
			
			if($setParam !== null) {
				$sth = $this->dbh->prepare("UPDATE ". $this->table ." SET quick_access = '". addslashes($setParam) ."' WHERE ". $idParam);
			} else {
				$sth = $this->dbh->prepare("UPDATE ". $this->table ." SET quick_access = NULL WHERE ". $idParam);
			}
			
			$sth->execute();
			
			return true;
		} else {
			return false;
		}
	}
	
	public function delete($condition = ""): bool {
		$primaryKey = $this->primaryKey;
		
		if( !empty($condition) ) {
			if( is_array($condition[$primaryKey]) || is_object($condition[$primaryKey]) ) {
				$where = implode(', ', $condition[$primaryKey]);
				$sth = $this->dbh->prepare("DELETE FROM ". $this->table ." WHERE ". $primaryKey ." IN (". $where .")");
			} elseif( is_array($condition) || is_object($condition) ) {
				
				foreach($condition as $key => $value) {
					$where[] = $key ." = ". addslashes($value);
				}
				$where = implode(' AND ', $where);
				
				$sth = $this->dbh->prepare("DELETE FROM ". $this->table ." WHERE ". $where);
				
			}
			
			if( !$sth ) {
				debug($sth->errorInfo());
				return false;
			}
			
			$sth->execute();
			
			return true;
		} else {
			return false;
		}
	}
	
	public function deleteJoin(array $condition): bool {
		$primaryKey = $this->primaryKey;
		$delete_request = "";
		
		if( !empty($condition) ) {
			foreach($condition['tables'] as $table => $primary) {
				$delete_request .= "DELETE FROM ". $condition['prefix'] . $table ." WHERE ". $primary ." = ". $condition['id'] .";";
			}
			
			$delete_request .= "DELETE FROM ". $this->table ." WHERE ". $primaryKey ." = ". $condition['id'] .";";
			
			$sth = $this->dbh->prepare($delete_request);
			
			if( !$sth ) {
				debug($sth->errorInfo());
				return false;
			}
			$sth->execute();
			
			return true;
		} else {
			return false;
		}
	}
	
	public function login(array|object $authCustomer) {
		$now = date('Y-m-d H:i:s');
		
		if( is_array($authCustomer) || is_object($authCustomer) ) {
			foreach($authCustomer as $key => $value) {
				if( $key === "password" ) {
					$where[] = $key .' = "'. $this->getHashPwd($value) .'"';
				} else {
					$where[] = $key .' = "'. addslashes($value) .'"';
				}
			}
		}
		
		$where = implode(" AND ", $where);
		
		$requete = 	"SELECT ". $this->table .".*, ". $this->config->dbprefix ."access.access_value
					FROM ". $this->table ."
					LEFT JOIN ". $this->config->dbprefix ."access ON ". $this->table .".access = ". $this->config->dbprefix ."access.id 
					WHERE ". $where ."";
		
		$sth = $this->dbh->prepare("SELECT * FROM ". $this->table ." WHERE ". $where ."");
		
		if( !$sth ) {
			debug($sth->errorInfo());
			return false;
		}
		
		$sth->execute();
		$result = $sth->fetch(PDO::FETCH_ASSOC);
		
		if( !$result ) {
			return false;
		}
		
		$sth = $this->dbh->prepare("UPDATE ". $this->table ." SET last_connection='". $now ."' WHERE id='". $result['id'] ."'");
		
		if( !$sth ) {
			debug($sth->errorInfo());
			return false;
		}
		
		$sth->execute();
		
		$result['last_connection'] = $now;
		
		return $result;
	}
	
	public function connect($customer) {
		$insertInto = [];
		$insertValue = [];
		
		$ua = $_SERVER['HTTP_USER_AGENT'];
		
		$insertInto[] = "id_customer";
		$insertValue[] = '"'. $customer['id'] .'"';
		$insertInto[] = "user_agent";
		$insertValue[] = '"'. $ua .'"';
		$insertInto[] = "session_id";
		$insertValue[] = '"'. $customer['session'] .'"';
		$insertInto[] = "date_connection";
		$insertValue[] = '"'. date("Y-m-d H:i") .'"';
		$insertInto[] = "action";
		$insertValue[] = '"'. $customer['log'] .'"';
		
		$insertInto = implode(", ", $insertInto);
		$insertValue = implode(", ", $insertValue);
		
		$sth = $this->dbh->prepare("INSERT INTO ". $this->table ."(". $insertInto .") VALUES (". $insertValue .")");
		
		if( !$sth ) {
			debug($sth->errorInfo());
			return false;
		}
		
		try {
			$sth->execute();
			$lastInsertId = $this->dbh->lastInsertId();
			
			return $lastInsertId;
		} 
		catch(PDOException $e) {
			$error_dbh = $this->dbhErrorInfo($e->errorInfo);
			debug($error_dbh, true);
			
			return false;
		}
	}
	
	public function getCustomerInfo(array $customer): array {
		$get_tables = array(
			'access_value' => "access",
			'address' => array(
				"id",
				"address",
				"postal_code",
				"city",
			),
			'phone' => array(
				"id",
				"phone",
			),
			'email' => array(
				"id",
				"email"
			),
			'website' => array(
				"website",
				"github",
				"twitter",
				"instagram",
				"facebook",
			),
			'webmail_connections' => array(
				"id",
				"server",
				"port",
				"connection_type",
				"email",
				"password_connection"
			)
		);
		
		foreach( $get_tables as $key => $value ) {
			if( $key === "access_value" ) {
				$sth = $this->dbh->prepare("SELECT ". $key ." FROM ". $this->config->dbprefix . $value ." WHERE id = ". $customer['access'] ."");
			} 
			else {
				$id_customer_info = ($key === "todos_chats") ? 'id_customer_todo' : 'id_customer';
				$sth = $this->dbh->prepare("
					SELECT ". implode(", ", $value) ." 
					FROM ". $this->config->dbprefix . $key ." 
					WHERE ". $id_customer_info ." = ". $customer['id'] ."
				");
			}
			
			if( !$sth ) {
				debug($sth->errorInfo());
				return false;
			}
			
			$sth->execute();
			
			foreach( $sth->fetchAll(PDO::FETCH_ASSOC) as $k => $v ) {
				if(count($v) > 1) {
					foreach($v as $index => $valueIndex) {
						if( $key === "website" ) {
							$customer[$key][$index] = $valueIndex;
						} else {
							$customer[$key][$k][$index] = $valueIndex;
						}
					}
				} else {
					if( $key === "access_value" ) {
						$customer[$key] = $v[$key];
					} else {
						$customer[$key][$k] = $v[$key];
					}
				}
			}
		}
		
		return $customer;
	}
}

?>