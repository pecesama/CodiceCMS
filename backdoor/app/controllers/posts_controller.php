<?php

class Posts_controller extends appcontroller{

	public function __construct(){
		parent::__construct();
	}

	public function beforeRender(){
		$this->view->active = array('entries' => 'active');
	}

	public function index($page = null){
		$post = new post();

		$total_rows = $post->countPosts(null);

		//preparing pagination.
		$page = (is_null($page)) ? 1 : $page ;
		$limit = $this->config['postsPerPageAdmin'];
		$offset = (($page-1) * $limit);
		$limitQuery = $offset.",".$limit;

		$targetpage = $this->path.'posts/index/';
		$pagination = $this->pagination->init($total_rows, $page, $limit, $targetpage);

		//preparing views
		$this->view->pagination = $pagination;
		$this->view->posts = $post->findAll(NULL, 'idPost DESC', $limitQuery, 'LEFT JOIN statuses ON posts.idStatus = statuses.idStatus');

		$this->title_for_layout('Control panel - Codice CMS');
		$this->render();
	}

	public function create(){
		$post = new post();

		if ($this->data) {

			// Get button value
			$btns = array_keys($this->data['btn']);
			unset($this->data['btn']);
			unset($this->data['tags']);

			// Get status id
			$status = new Status();
			$status->findBy('name', $btns[0]);

			$post['idStatus'] = $status['idStatus'] != FALSE? $status['idStatus']: 2;

			if (!preg_match("/\S+/",$this->data['title']) OR $this->data['title'] == '') {
				$this->data['title'] = 'Untitled';
			}

			// Generate urlfriendly
			$this->data['urlfriendly'] = $post->buildUrl($this->data['title']);

			$post->prepareFromArray($this->data);
			$post->idUser = $this->session->user['idUser'];

			if ($post->save()) {
				// TODO: Validate if every tag is saved
				$relTag = new RelTag();
				$relTag->updateRel($post['idPost'], $this->data['tags']);

				$this->messages->addMessage(Message::SUCCESS, 'New posts saved.');
				$this->redirect('posts/');
			} else {
				$this->messages->addMessage(Message::ERROR, 'We can\'t save the post.');
				$postView = $this->data;
			}

		} else {
			$postView = $post->find(0);
			$postView['tags'] = '';
		}

		$this->view->post = $postView;
		$this->title_for_layout($this->l10n->__('Add entry - Codice CMS'));
		$this->render();
	}

	public function view($urlFriendly = null){
		// Find post
		$post = new post();
		$this->view->post = $post->findBy('urlfriendly', $urlFriendly);

		// if id is null or post is new
		if( is_null($urlFriendly) || $post->isNew() ){
			$this->redirect('posts/');
		}

		// find author, it's a user
		$user = new user();
		$this->view->user = $user->find($post['idUser']);

		// find post status
		$status = new status();
		$this->view->status = $status->find($post['idStatus']);

		// find comments
		$comment = new comment();
		$comments = $comment->findAllBy('idPost', $post['idPost']);

		// FIXME: make a sql join
		foreach($comments as $k => $comment){
			$status = new status();
			$status->find($comment['idStatus']);
			$comments[$k]['status'] = $status['name'];
		}
		// endfixme
		$this->view->comments = $comments;

		$this->title_for_layout("Entry - {$post['title']}");
		$this->render();
	}

	public function update($id = null){
		$id = (int) $id;
		if($id <= 0){
			$this->redirect("posts/");
		}

		// Get status for posts
		$status = new status();
		$statuses = $status->findAll();

		// Find post to edit
		$P = new post();
		$P->find($id);

		// if request is post and post isn't new
		if ($this->data && $P->isNew() == FALSE) {

			if(!preg_match("/\S+/",$this->data['title']) OR $this->data['title'] == ""){
				$this->data['title'] = 'Untitled';
			}
			/*
			if(!preg_match("/\S+/",$this->data['urlfriendly']) OR $this->data['urlfriendly'] == ""){
				$this->data['urlfriendly'] = $this->data['title'];
			}
			*/
			if($P['title'] != $this->data['title']){
				$this->data['urlfriendly'] = $P->buildUrl($this->data['title'], $id);
			}

			// update tags registry and relations
			$relTag = new RelTag();
			$relTag->updateRel($id,$this->data['tags']);

			$P->prepareFromArray($this->data);

			if($P->save()){
				$this->session->flash('Información guardada correctamente.');
				$this->redirect("posts/view/{$P['urlfriendly']}");
			} else {

			}

		}

		$P = new post();

		$post = $P->find($id);
		$post['title'] = utils::convert2HTML($P['title']);
		$post['content'] = utils::convert2HTML($P['content']);

		$tag = new Tag();
		$tags = $tag->getByPost($id);
		$post['tags'] = Tag::toString($tags);

		$this->title_for_layout($this->l10n->__('Update entry - Codice CMS'));

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
			$this->messages->addMessage(Message::WARNING, 'No se encontro el post.');
			$this->redirect('posts/');
		}

		if($post->delete()){
			$this->messages->addMessage(Message::SUCCESS, 'Registro eliminado.');
		} else {
			$this->messages->addMessage(Message::ERROR, 'No se elimino el post.');
		}

		$this->redirect('posts/');
	}

}


