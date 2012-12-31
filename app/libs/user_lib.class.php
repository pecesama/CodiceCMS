<?php

class User_lib extends singleton{

	private $session;

	public static function getInstance() {
		return parent::getInstance(get_class());
	}

	public function __construct(){
		$this->session = session::getInstance();
	}

	//Returns TRUE if is logged or FALSE if not.
	public function isLogged(){
		if($this->session->check("logged") == TRUE) {
			return TRUE;
		}else{
			return FALSE;
		}
	}
}