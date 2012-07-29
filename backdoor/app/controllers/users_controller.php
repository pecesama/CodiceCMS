<?php

class Users_Controller extends appcontroller{

	public function __construct(){
		parent::__construct();

		if($this->User->isLogged() === FALSE){
			$this->redirect("login");
		}
	}

	/*
	 * This action shows the complete list of users. 
	 */
	public function index($page = 1){
		$U = new user();

		$total_rows = $U->countUsers();
		$page = (is_null($page)) ? 1 : $page ;
		$limit = $this->config["user"]['posts_per_page'];
		$offset = (($page-1) * $limit);
		$limitQuery = $offset.",".$limit;
		$targetpage = $this->path.'users/';
		$pagination = $this->pagination->init($total_rows, $page, $limit, $targetpage);
		$this->view->pagination = $pagination;

		$users = $U->findAll(null, "idUser DESC", $limitQuery, null);

		foreach($users as $key => $user){
			$users[$key]['created'] = dates::timeago(strtotime($user['created']));
		}

		$this->view->users = $users;

		$this->title_for_layout("Users management");
		$this->render();
	}

	public function update($idUser = null){
		if(is_null($idUser) === true){//if we don't have and $idUser coming by GET
			$this->redirect("users/index");//we redirect to users list
		}

		if($this->data){
			$user = $this->data['user'];

			$U = new user();
			$U->find($idUser);

			if(preg_match('/^ *$/',$user['password'])){
				unset($user['password']);
			}else{
				$user['password'] = md5($user['password']);
			}

			$U->prepareFromArray($user);
			$saved = $U->save();

			if($saved){
				$this->messages->addMessage(Message::SUCCESS, "The user \"".htmlentities($user['user'])."\" was updated succesfully.");
			}else{
				$this->messages->addMessage(Message::ERROR, "There was an error while saving the data of the user. Just try again.");
			}

			$this->redirect("users/update/$idUser");
		}

		$U = new user();
		$user = $U->find($idUser);

		$user = array_map("htmlentities", $user);

		$this->view->user = $user;

		$this->title_for_layout("User " . htmlentities($user['user']));
		$this->render("add");
	}

	public function add(){

		if($this->data){
			$user = $this->data['user'];
			$user['password'] = md5($user['password']);
			
			$U = new user();
			$U->prepareFromArray($user);
			$action = $U->save();

			if($action){
				$this->messages->addMessage(Message::SUCCESS, "The user has added succesfully");
			}else{
				$this->messages->addMessage(Message::ERROR, "There was an error while trying to save. Just try again.");
			}

			$this->redirect("users/add");
		}

		$this->title_for_layout("New user");
		$this->render();		
	}

	public function remove($idUser = null){

		$U = new user();
		$user = $U->find($idUser);
		$U->delete($idUser);

		$this->messages->addMessage(Message::SUCCESS, "The user \"" . htmlentities($user['user']) . "\" has been deleted." );
		$this->redirect("users");
	}

}
