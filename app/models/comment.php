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
		$idPost = $this->db->sql_escape($idPost);
		$status = $this->db->sql_escape($status);

		$sql = "SELECT COUNT(*) AS total FROM comments AS c
		INNER JOIN posts AS p ON p.idPost = c.idPost
		INNER JOIN statuses AS s on s.idStatus = c.idStatus
		WHERE ";

		$sql .= (is_null($status))?"":"s.name = '$status' ";
		$sql .= (is_null($idPost))?"":"AND p.idPost = '$idPost' ";
  		
		$valid = $this->findBySql($sql);

		if($valid){				
			return $valid['total'];
		}
			
		return 0;
	}
	
	public function getAll($idPost, $idStatus = null){
		$C = new comment();

		$rows = array();
		if(is_null($idStatus) === true){
			$rows = $C->findAll(
				'comments.*, md5(comments.email) as md5_email',
				'created ASC',
				null,
				"WHERE idPost={$idPost}"
			);
		}else if(is_array($idStatus)){
			$status_sql = "";
			foreach($idStatus as $st){
				$status_sql .= "idStatus = '$st' OR ";
			}
			$status_sql = substr($status_sql,0,-4);
			
			$rows = $C->findAll(
				'comments.*, md5(comments.email) as md5_email',
				'created ASC',
				null,
				"WHERE idPost={$idPost} AND ($status_sql)"
			);
		}else{
			$rows = $C->findAll(
				'comments.*, md5(comments.email) as md5_email',
				'created ASC',
				null,
				"WHERE idPost={$idPost} AND idStatus='$idStatus'"
			);
		}
		
		foreach($rows as $key => $comment){
			$comment['content'] = utils::htmlentities($comment['content']);
			$comment['content'] = utils::nl2br($comment['content']);
			
			$rows[$key] = $comment;
		}
		
		return $rows;
	}
}
