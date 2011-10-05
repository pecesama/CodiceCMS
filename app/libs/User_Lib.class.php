<?php

class User_lib{

	private $session;

	public function __construct(){
		$this->session = session::getInstance();
	}

	//Validates if is logged, if not, redirects to login.
	public function validateLogin(){
		if($this->session->check("logged") == false) {
			$this->redirect("login/nosession/");
		}
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