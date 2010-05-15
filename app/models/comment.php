<?php

class comment extends models {

	private $spam;
	private $security;
	
	protected $filter;
	protected $validate;

	public function __construct() {
		parent::__construct();

		$this->spam = antispam::getInstance();
		$this->security = security::getInstance();	
		
		$this->filter = array(
			'content' => array(			
				'filters' => array(
					/*
						xssClean no deja que meta código php dentro de <code lang="php">...</code>
						prueba con el contenido de esta entrada http://bugs.php.net/bug.php?id=47567 
						hasta que funcione descomentar la linea siguiente. :)
						
						TODO: improvisar un filtro anti-xss mas suave o arreglar el anterior.
					*/
					#array('xssClean', 'true')
				)
			),
			'suscribe' => array(
				'filters' => array(
					array('trueOrFalse')
				)
			)
		);	
	
		$this->validate = array(
			'author' => array(
				'required' => true,
				'rules' => array(
					array(
						'rule' => VALID_NOT_EMPTY,
						'message' => 'Por favor introduce tu Nombre.',
					)
				)
			),
			'url' => array(
				'rules' => array(
					array(
						'rule' => VALID_URL,
						'message' => 'No es una URL valida.'
					)
				)
			),
			'email' => array(
				'required' => true,
				'rules' => array(
					array(
						'rule' => VALID_EMAIL,
						'message' => 'El e-mail no es valido.'
					)
				)
			),
			'content' => array(
				'required' => true,
				'rules' => array(
					array(
						'rule' => VALID_NOT_EMPTY,
						'message' => 'Debes introducir un comentario.',
					),
					array(
						'rule' => array('isSpam'),
						'message' => 'No se aceptan comentarios en blanco o con spam.',
					)
				)
			)
		);
	}
	
	public function setPingback(){
		$this->validate['email']['required'] = false;
	}
	
	public function trueOrFalse($value){
		if($value == 'on' or $value == 1)
			return 1;
		return 0;
	}
	
	public function xssClean($value, $params) {
		$type = (isset($params[0]))? $params[0] : 'false';
		return $this->security->clean($value, $type);
	}
	
	public function isSpam($value) {
		$valid = false;     
		if (empty($value)) {
			$valid = false;
		} else {
			if ($this->spam->isSpam($value) == false) {
				$valid = true;
			} else {
				$valid = false;
			}
		}		
		return $valid;
	}
	
	public function countCommentsByPost($idPost = null,$status = null){
	
		$sql = "SELECT count(*) as total FROM `comments` WHERE 1 = 1 ";
		$sql.= !is_null($status)?"AND status = '$status'":'';
		$sql .= !is_null($idPost)?"AND id_post = $idPost":'';

		$valid = $this->findBySql($sql);	
		
		if($valid){				
			return $valid['total'];
		}
			
		return 0;
	}
	
}
