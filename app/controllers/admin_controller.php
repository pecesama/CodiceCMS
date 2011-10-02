<?php

class admin_controller extends appcontroller {

	private $blogConfig;

	public function __construct() {
		parent::__construct();
		
		$R = registry::getInstance();
		$class = $R->router->getClass();
		
		if($class["action"] != "login" && $class["action"] != "logout") {
			if($this->session->check("logged") == false) {
				$this->redirect("admin/login/nosession/");
			}
		}
		
		$this->plugin->call('admin_init');
		
		$C = new configuration();
		$this->blogConfig = $C->getBlogConfiguration();
		$this->userConf = $C->getUserConfiguration(1);
		
		$this->view->blogConfig = $this->blogConfig;
		$this->view->userConf = $this->userConf;
	}

	public function index($id = NULL){
		$P = new post();
		
		$total_rows = $P->countPosts();
		
		$page = $id;
		$page = (is_null($page)) ? 1 : $page ;
		$limit = $this->userConf['posts_per_page'];
		$offset = (($page-1) * $limit);
		$limitQuery = $offset.",".$limit;
		
		$targetpage = $this->path.'admin/index/';
		$pagination = $this->pagination->init($total_rows, $page, $limit, $targetpage);
		
		$this->title_for_layout("Administraci&oacute;n - Codice CMS");
		
		$this->view->pagination = $pagination;
		$this->view->posts = $P->findAll(NULL, "ID DESC", $limitQuery, NULL);
		
		$this->view->setLayout("admin");
		$this->render();
	}
	
	public function login($msg = null){
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
		
		if($this->data){
			$U = new user();
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
		if ($this->data) {
			$P = new post();
			if(isset($this->data['cancelar'])) {
				$this->redirect("admin/");
			}
			
			if (isset($this->data['borrador'])) {
				$this->data['status'] = 'draft';
				unset($this->data['borrador']);
				
			} elseif (isset($this->data['publicar'])) {
				$this->data['status'] = 'publish';
				unset($this->data['publicar']);
			} else {
				$this->redirect("admin/");
			}
			
			if(!preg_match("/\S+/",$this->data['title']) OR $this->data['title'] == ""){
				$this->data['title'] = "Untitled";
			}
			
			$this->data['urlfriendly'] = $P->buildUrl($this->data['title']);
			
			$tags = $this->data['tags'];
			unset($this->data['tags']);
			
			$P->prepareFromArray($this->data);
			$P->save();
			
			$post_id = $P->db->lastId();
			$P->updateTags($post_id,$tags);
			
			$this->redirect("admin/");
		} else {
			$this->view->setLayout("admin");
			$this->title_for_layout($this->l10n->__("Agregar post - Codice CMS"));
			$this->render();
		}
	}

	public function edit($id = NULL) {
		$id = (int) $id;
		if(!$id)$this->redirect('admin');
		
		$statuses = array(
			"publish",
			"draft"
		);
		
		if ($this->data) {
			if(isset($this->data['cancelar'])){
				$this->redirect("admin/");
			}else{
				$P = new post();
				$P->find($id); 
				
				if(!preg_match("/\S+/",$this->data['title']) OR $this->data['title'] == ""){
					$this->data['title'] = "Untitled";
				}
				
				if(!preg_match("/\S+/",$this->data['urlfriendly']) OR $this->data['urlfriendly'] == ""){
					$this->data['urlfriendly'] = $this->data['title'];
				}
				
				$this->data['urlfriendly'] = $P->buildUrl($this->data['urlfriendly'], $id);
				
	 			$P->updateTags($id,$this->data['tags']);
				unset($this->data['tags']);
				
				$P->prepareFromArray($this->data);
				
				$P->save();
				
				$this->session->flash('Información guardada correctamente.');
				
				$this->redirect("admin/edit/$id");
			}
		}
		
		$P = new post();
		
		$post = $P->find($id);
		$post['title'] = utils::convert2HTML($P['title']);
		$post['content'] = utils::convert2HTML($P['content']);
		$post['tags'] = $P->getTags($id,'string');
		
		$this->title_for_layout($this->l10n->__("Editar post - Codice CMS"));
		
		$this->view->id = $id;
		$this->view->post = $post;
		$this->view->statuses = $statuses;
		
		$this->view->setLayout("admin");
		$this->render();
	}

	public function remove($id){
		$P = new post();
		$P->find($id);
		$P->delete();
		
		$this->redirect("admin/");
	}

	public function config($id = null){
		if($this->data){
			$C = new configuration();
			
			foreach($this->data as $name => $value){
				if($C->findBy("name", $name)){
					//updating
					$C['value'] = trim($value);
					$C->save();
				}else{
					//adding new record.
					$C = new configuration();
					
					$new_value = array();
					$new_value['name'] = $name;
					$new_value['value'] = $value;
					$new_value['id_user'] = 1;
					
					$C->prepareFromArray($new_value);
					$C->save();
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
