<?php

class user extends models{
	public function __construct(){
		parent::__construct();
	}
	
	public function validateLogin($data){
		$valid = $this->findBySql("SELECT idUser, user, password FROM users WHERE user='".$this->sql_escape($data['login'])."' AND password='".md5($data["password"])."'");
		if(empty($valid) == false) {
			return $valid['idUser'];
		}
		return false;
	}


	public function countUsers(){
		$result = $this->findBySql("SELECT count(*) as total FROM users");

		return $result['total'];
	}
}