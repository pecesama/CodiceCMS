<?php

class Posts_controller extends AppController{
	
	public function __construct(){
		parent::__construct();

		if($this->User->isLogged() === FALSE){
			$this->redirect("login");
		}
	}

	public function index($page = null){
            $post = new post();

            $total_rows = $post->countPosts();

            //preparing pagination.
            $page = (is_null($page)) ? 1 : $page ;
            $limit = $this->config["user"]["posts_per_page"];
            $offset = (($page-1) * $limit);
            $limitQuery = $offset.",".$limit;

            $targetpage = $this->path.'posts/index/';
            $pagination = $this->pagination->init($total_rows, $page, $limit, $targetpage);

            //preparing views
            $this->view->pagination = $pagination;
            $this->view->posts = $post->findAll(NULL, "idPost DESC", $limitQuery, "LEFT JOIN statuses ON posts.idStatus = statuses.idStatus");

            $this->title_for_layout("Control panel - Codice CMS");
            $this->render();
	}

	public function create(){
            
            $post = new post();
            
            if ($this->data) {
                
                // Get button value
                $btns = array_keys($this->data['btn']);
                
                
                // Get status id
                $status = new status();
                $status->findBy('name', $btns[0]);

                $post['idStatus'] = $status['idStatus'] != FALSE?$status['idStatus']:2;

                if(!preg_match("/\S+/",$this->data['title']) OR $this->data['title'] == ""){
                    $this->data['title'] = "Untitled";
                }
                
                // FIXME: Porque se pide el campo urlfiendly
                $this->data['urlfriendly'] = $post->buildUrl($this->data['title']);

                $post->prepareFromArray($this->data);
                if($post->save()){
                    // TODO: Validar que se agregar las tags
                    $post->updateTags($post['idPost'], $this->data['tags']);
                    
                    $this->messages->addMessage(Message::SUCCESS, "New posts saved.");
                    $this->redirect("posts/");
                } else {
                    $this->messages->addMessage(Message::ERROR, "We can't save the post.");
                    $postView = $this->data;
                }
                
            } else {
                $postView = $post->find(0);
                $postView['tags'] = "";
            }
            
            $this->view->post = $postView;
            $this->title_for_layout($this->l10n->__("Add entry - Codice CMS"));
            $this->render();
	}

	public function read(){
		
	}

	public function update($id = null){
		$id = (int) $id;
		if($id <= 0){
                    $this->redirect("posts/");
		}
                
                // Get status for posts
                $status = new status();
		$statuses = $status->findAll();
		
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
				
				$this->redirect("posts/update/$id");
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
		
		$this->render();
	}

	public function delete($id = null){
            $id = (int) $id;
            $post = new post();
            $post->find($id);

            if($id <= 0 || $post->isNew()){
                $this->messages->addMessage(Message::WARNING, "No se encontro el post.");
                $this->redirect("posts/");
            }

            if($post->delete()){
                $this->messages->addMessage(Message::SUCCESS, "Registro eliminado.");
            } else {
                $this->messages->addMessage(Message::ERROR, "No se elimino el post.");
            }

            $this->redirect("posts/");
	}
	
}