<?php

class Entries_controller extends AppController{
	
	public function __construct(){
		parent::__construct();

		if($this->User->isLogged() === FALSE){
			$this->redirect("login");
		}
	}

	public function index($page = null){
		$P = new post();
		
		$total_rows = $P->countPosts();
		
		//preparing pagination.
		$page = (is_null($page)) ? 1 : $page ;
		$limit = $this->config["user"]["posts_per_page"];
		$offset = (($page-1) * $limit);
		$limitQuery = $offset.",".$limit;
		
		$targetpage = $this->path.'entries/index/';
		$pagination = $this->pagination->init($total_rows, $page, $limit, $targetpage);
		
		//preparing views
		$this->title_for_layout("Control panel - Codice CMS");
		
		$this->view->pagination = $pagination;
		$this->view->posts = $P->findAll(NULL, "ID DESC", $limitQuery, NULL);

		$this->view->setLayout("admin");
		$this->render();
	}

	public function create(){
		if ($this->data) {
			$P = new post();
			if(isset($this->data['cancelar'])) {
				$this->redirect("entries");
			}
			
			if (isset($this->data['borrador'])) {
				$this->data['status'] = 'draft';
				unset($this->data['borrador']);
				
			} elseif (isset($this->data['publicar'])) {
				$this->data['status'] = 'publish';
				unset($this->data['publicar']);
			} else {
				$this->redirect("entries");
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
			
			$this->redirect("entries");
		} else {
			$this->title_for_layout($this->l10n->__("Add entry - Codice CMS"));
			$this->view->setLayout("admin");

			$this->render();
		}
	}

	public function read(){
		
	}

	public function update($id = null){
		$id = (int) $id;
		if($id <= 0){
			$this->redirect("entries");
		}

		$statuses = array(
			"publish",
			"draft"
		);
		
		if ($this->data) {
			if(isset($this->data['cancelar'])){
				$this->redirect("entries");
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
				
				$this->redirect("entries/update/$id");
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

	public function delete(){
		$P = new post();
		$P->find($id);
		$P->delete();

		$this->redirect("entries");
	}
	
}