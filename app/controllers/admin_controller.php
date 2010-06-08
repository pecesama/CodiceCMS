<?php

class admin_controller extends appcontroller {

	private $conf;

	public function __construct() {
		parent::__construct();
		
		$registry = registry::getInstance();
		$class = $registry->router->getClass();
		if($class["action"] != "login" && $class["action"] != "logout") {
			if($this->session->check("logged") == false) {
				$this->redirect("admin/login/nosession/");
			}
		}
		
		$this->plugin->call('admin_init');
		
		$config = new configuration();
		$blogConfig = $config->getBlogConfiguration();
		$userConfig = $config->getUserConfiguration(1);

		$this->conf = $blogConfig;
		$this->userConf = $userConfig;
	}

	public function index($id = NULL){
		$this->view->conf = $this->conf;
		$this->view->userConf = $this->userConf;
		
		$Post = new post();
				
		$total_rows = $Post->countPosts();
		
		$page = $id;
		$page = (is_null($page)) ? 1 : $page ;
		$limit = $this->userConf['posts_per_page'];
		$offset = (($page-1) * $limit);
		$limitQuery = $offset.",".$limit;
		
		$targetpage = $this->path.'admin/index/';
		$pagination = $this->pagination->init($total_rows, $page, $limit, $targetpage);
		
		$this->view->pagination = $pagination;
		$this->view->posts = $Post->findAll(NULL, "ID DESC", $limitQuery, NULL);
		$this->view->setLayout("admin");
		
		$this->title_for_layout("Administraci&oacute;n - Codice CMS");
		
		$this->render();
	}
	
	public function login($msg = null){
		$this->view->conf = $this->conf;
		$this->view->userConf = $this->userConf;
		
		if($this->session->check("logged") == true) {
			$this->redirect("admin");
		}

		if ($msg == "nosession") {
			$this->session->flash("La URL solicitada necesita autentificacion.");
		} elseif ($msg == "fail") {
			$this->session->flash("Lo siento, la informacion ingresada es incorrecta.");
		} elseif ($msg == "logout") {
			$this->session->flash("Haz terminado la sesion correctamente.");
		}
		
		$U = new user();
		if($this->data){
			if($id_user = $U->validateLogin($this->data)) {
				$user = $U->find($id_user);
				$this->session->user = $user;
				$this->session->logged = true;
				$this->redirect("admin/");
			} else {
				$this->redirect("admin/login/fail/");
			}
		}else{
			$this->view->setLayout("admin");
			$this->title_for_layout("Login - Codice CMS");
			$this->render();
		}
	}

	public function add(){
		$this->view->conf = $this->conf;
		$this->view->userConf = $this->userConf;
		
		$post = new post();
		if ($_SERVER["REQUEST_METHOD"]=="POST") {
		
			if(isset($_POST['cancelar'])) {
				$this->redirect("admin/");
			}
			
			if (isset($_POST['borrador'])) {
				$_POST['status'] = 'draft';
				unset($_POST['borrador']);
				
			} elseif (isset($_POST['publicar'])) {
				$_POST['status'] = 'publish';
				unset($_POST['publicar']);
			} else {
				$this->redirect("admin/");
			}
			
			if(!preg_match("/\S+/",$_POST['title']) OR $_POST['title'] == ""){
				$_POST['title'] = "Untitled";
			}
			
			$_POST['urlfriendly'] = $post->buildUrl($_POST['title']);

			$tags = $_POST['tags'];
			unset($_POST['tags']);

			$post->prepareFromArray($_POST);
			$post->save();

			$post_id = $post->db->lastId();
			$post->updateTags($post_id,$tags);

			$this->redirect("admin/");
		} else {
			$this->view->setLayout("admin");
			$this->title_for_layout($this->l10n->__("Agregar post - Codice CMS"));
			$this->render();
		}
	}

	public function edit($id = NULL) {
		$this->view->conf = $this->conf;
		$this->view->userConf = $this->userConf;
		
		$id = (int) $id;
		if(!$id)$this->redirect('admin');

		$post = new post();
		$post->find($id);
		$post['title'] = utils::convert2HTML($post['title']);
		$post['content'] = utils::convert2HTML($post['content']);
		$post['tags'] = $post->getTags($id,'string');

		$this->view->post = $post;
		$this->view->id = $id;
		$statuses = array("publish", "draft");
		$this->view->statuses = $statuses;
		if ($_SERVER["REQUEST_METHOD"]=="POST") {
			if(isset($_POST['cancelar'])){
				$this->redirect("admin/");
			} else {
				###########
				# Las siguientes dos lineas no deberian estar pero algo anda mal con el ActiveRecord que no deja las variables
				# de las consultas que se realizan directamente desde dentro de algun metodo en el model con $this->db->query e interfiere
				# con el actualizar por que podria haber campos que no se requieren en la actualizacion.
				###########
				$post = new post();#######
				$post->find($id);####### 
						
				if(!preg_match("/\S+/",$_POST['title']) OR $_POST['title'] == ""){
					$_POST['title'] = "Untitled";
				}
				
				if(!preg_match("/\S+/",$_POST['urlfriendly']) OR $_POST['urlfriendly'] == ""){
					$_POST['urlfriendly'] = $_POST['title'];
				}
				
				$_POST['urlfriendly'] = $post->buildUrl($_POST['urlfriendly'], $id);

	 			$post->updateTags($id,$_POST['tags']);
				unset($_POST['tags']);

				$post->prepareFromArray($_POST);

				$post->save();

				$this->redirect("admin/edit/$id");
			}
		} else {
			$this->view->setLayout("admin");
			$this->title_for_layout($this->l10n->__("Editar post - Codice CMS"));
			$this->render();
		}
	}

	public function remove($id){
		$post = new post();
		$post->find($id);
		$post->delete();
		$this->redirect("admin/");
	}
		
	public function config($id = null){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$Conf = new configuration();
			
			foreach($_POST as $name => $value){	
				if($Conf->findBy("name", $name)){
					$Conf['value'] = trim($value);
					$Conf->save();
				}else{
					$Conf = new configuration();
					
					$conf['name'] = $name;
					$conf['value'] = $value;
					$conf['id_user'] = 1;
					
					$Conf->prepareFromArray($conf);
					$Conf->save();
				}
			}
			
			$this->redirect("admin/config");
		}
		
		$this->registry->conf = $this->conf;
		$this->registry->userConf = $this->userConf;
		$this->plugin->call('admin_init_config');

		$this->view->conf = $this->registry->conf;		
		$this->view->userConf = $this->registry->userConf;

		$this->view->setLayout("admin");
		$this->render();
	}	

	function logout() {
		$this->session->destroy("id_user");
		$this->session->destroy("logged");
		$this->redirect("admin/login/logout/");
	}

}
