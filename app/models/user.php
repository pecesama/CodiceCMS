<?php

class user extends models{

	protected $validate;

	public function __construct(){
		parent::__construct();

		$this->validate = array(
			'user' => array(
				'required' => true,
				'rules' => array(
					array(
						'rule' => VALID_NOT_EMPTY,
						'message' => 'Fill the user field.'
					)
				)
			),
			'password' => array(
				'required' => true,
				'rules' => array(
					array(
						'rule' => VALID_NOT_EMPTY,
						'message' => 'Fill the password field.'
					)
				)
			),
			'email' => array(
				'required' => true,
				'rules' => array(
					array(
						'rule' => VALID_EMAIL,
						'message' => 'Fill the email field with a valid email.'
					)
				)
			),
			
		);
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