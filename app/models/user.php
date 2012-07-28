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
						'rule' => array('validate_user_exists'),
						'message' => 'User already exists. Please choose a different one.'
					),
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
			'website' => array(
				'required' => false,
				'rules' => array(
					'rule' => array(
						'rule' => VALID_URL,
						'message' => 'The url is not valid. Enter a valid url.'
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

	/* 
	 * This function makes sure that User doesn't exist to be able to create a new one
	 */
	public function validate_user_exists($user){
		$datos = $this->registry->datos;

		if(isset($datos['idUser'])){ //1. Dealing with a record update...
			$U = new user();
			$user = $U->find($datos['idUser']);
			
			if($user['user'] == $datos['user']){
				return true; //It's ok, user is using same 'user' name.
			}else{ //User is trying to change it's 'user' name...
				$U = new user();
				$U->findBy("user", $datos['user']);

				if($U->isNew() === false){
					return false; //The 'user' already exists.
				}else{
					return true; //The 'user' name doesn't exist, it's ok.
				}
			}
		}else{ //2. Adding a new user
			$U = new user();
			$U->findby('user', $datos['user']);

			if($U->isNew() === false){ //Does the 'user' already exists?
				return false; //The 'user' already exists.
			}else{
				return true; //The 'user' doesn't exist.
			}
		}
	}

}