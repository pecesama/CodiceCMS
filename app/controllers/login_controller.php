<?php

class Login_controller extends AppController {

	private $blogConfig;

	public function __construct() {
		parent::__construct();

		$R = registry::getInstance();
		$class = $R->router->getClass();
		
		if($class["action"] != "index" && $class["action"] != "logout") {
			if($this->session->check("logged") == false) {
				$this->redirect("login/index/nosession/");
			}
		}
		
		$this->plugin->call('admin_init');
		
		$C = new configuration();
		$this->blogConfig = $C->getBlogConfiguration();
		$this->userConf = $C->getUserConfiguration(1);
	}

	public function index($msg = null){
		if($this->session->check("logged") == true) {
			$this->redirect("entries");
		}
		
		//FIXME: utilizar libjrería para mensajes.
		if ($msg == "nosession") {
			$this->session->flash("La URL solicitada necesita autentificacion.");
		} elseif ($msg == "fail") {
			$this->session->flash("Lo siento, la informacion ingresada es incorrecta.");
		} elseif ($msg == "logout") {
			$this->session->flash("Haz terminado la sesion correctamente.");
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

			$this->view->blogConfig = $this->blogConfig;
			$this->view->userConf = $this->userConf;

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
