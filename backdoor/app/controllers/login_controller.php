<?php

class Login_controller extends AppController {
	public function __construct() {
		parent::__construct();
		
		$this->plugin->call('admin_init');
	}

	public function index($msg = null){
		if($this->session->check("logged") == true) {
			$this->redirect("posts");
		}

		//FIXME: utilizar librería para mensajes.
		if ($msg == "nosession") {
			$this->session->flash("You need to authenticate to get in this place. Please use your credentiales in the form below.");
			$this->redirect("login");
		} elseif ($msg == "fail") {
			$this->session->flash("The username or password you entered is incorrect.");
			$this->redirect("login");
		} elseif ($msg == "logout") {
			$this->session->flash("Your session has terminated.");
			$this->redirect("login");
		}

		if($this->data){
			$U = new user();
			if($id_user = $U->validateLogin($this->data)) {
				$user = $U->find($id_user);
				$this->session->user = $user;
				$this->session->logged = true;
				$this->redirect("login/");
			} else {
				$this->redirect("login/index/fail/");
			}
		}else{
			$this->view->setLayout("admin");
			$this->title_for_layout("Login - Codice CMS");
			$this->render();
		}
	}

	function logout() {
		$this->session->destroy("id_user");
		$this->session->destroy("logged");
		$this->redirect("login/index/logout/");
	}

}