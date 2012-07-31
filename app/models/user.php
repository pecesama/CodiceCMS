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
					),
					array(
						'rule' => array('validate_user_characters'),
						'message' => '- User must contains only: a-z . or 0-9 <br /> - Must not start with Numbers or _ <br /> - Must not starts or end with . <br /> - And must be at least 6 characters'
					),
					array(
						'rule' => array('validate_user_exists'),
						'message' => 'User already exists. Please choose a different one.'
					),
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
						'rule' => VALID_NOT_EMPTY,
						'message' => 'Fill the email field.'
					),
					array(
						'rule' => VALID_EMAIL,
						'message' => 'Fill the email field with a valid email.'
					),
					array(
						'rule' => array('validate_email_exists'),
						'message' => 'Email already exists. Please choose a different one.'
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

	/*
	 * Validates that user has at least 6 characters, and must be only a-z '_' and '.'.
	 */
	public function validate_user_characters($user){
		$valid = preg_match('/^[a-z\_\.0-9]{6,}$/i', $user); //User must be only contain: a-z . or 0-9

		if($valid){
			if(preg_match('/^[0-9_]/', $user)){ //Must not start with numbers or _
				return false;
			}else if(strpos($user, '..') !== false){ //Must not have .. or more
				return false;
			}else if(preg_match('/^\.+/', $user)){ //Must not start with . 
				return false;
			}else if(preg_match('/\.+$/', $user)){ //Must not end with . 
				return false;
			}
		}else{
			return false;
		}

		return $valid;
	}

	/* 
	 * This function makes sure that Email doesn't exist to be able to create a new one
	 */
	public function validate_email_exists($email){
		$datos = $this->registry->datos;

		if(isset($datos['idUser'])){ //1. Dealing with a record update...
			$U = new user();
			$user = $U->find($datos['idUser']);

			if($user['email'] == $datos['email']){
				return true; //It's ok, email is using same 'email' name.
			}else{ //User is trying to change it's 'email' name...
				$U = new user();
				$U->findBy("email", $datos['email']);

				if($U->isNew() === false){
					return false; //The 'email' already exists.
				}else{
					return true; //The 'email' name doesn't exist, it's ok.
				}
			}
		}else{ //2. Adding a new email
			$U = new user();
			$U->findby('email', $datos['email']);

			if($U->isNew() === false){ //Does the 'email' already exists?
				return false; //The 'email' already exists.
			}else{
				return true; //The 'email' doesn't exist.
			}
		}
	}

}