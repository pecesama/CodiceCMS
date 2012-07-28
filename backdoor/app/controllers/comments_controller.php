<?php

class comments_controller extends appcontroller{
	public function __construct(){
		parent::__construct();

		if($this->User->isLogged() === FALSE){
			$this->redirect("login");
		}
	}
	
	public function beforeRender(){
		$this->view->active = array('comments' => 'active');
	}
	
	public function index($id = NULL){
		
		$this->title_for_layout($this->l10n->__("Comentarios - Codice CMS"));

		$comment = new comment();
		$total_rows = $comment->countCommentsByPost();
		$page = $id;
		$page = (is_null($page)) ? 1 : $page ;
		$limit = $this->config['postsPerPageAdmin'];
		$offset = (($page-1) * $limit);
		$limitQuery = $offset.",".$limit;
		$targetpage = $this->path.'comments/';
		$pagination = $this->pagination->init($total_rows, $page, $limit, $targetpage);
		$this->view->pagination = $pagination;

		$comments = $comment->findAll(NULL, "idComment DESC", $limitQuery, NULL);
		
		foreach($comments as $key => $value){
			$Post = new post();
			$post = $Post->find($value['idPost']);

			$value['post'] = array(
				'urlfriendly' => $post['urlfriendly'],
				'title' => $post['title']
			);

			$value["content"] = utils::htmlentities($value["content"]);
			$value["content"] = utils::nl2br($value["content"]);
			
			// status
			$status = new status();
			$status->find($value['idStatus']);
			$value['status'] = $status['name'];
			
			$comments[$key] = $value;
		}
		
		$this->registry->comments = $comments;
		
		$this->plugin->call("comments_comment_content");
		$this->view->comments = $this->registry->comments;

		$this->render();
	}
	
	public function update($id = NULL) {
		$id = (int) $id;
		if(!$id)$this->redirect('comments');

		$Comment = new comment();
		$comment = $Comment->find($id);

		$comment['content'] = utils::convert2HTML($comment['content']);

		$Post = new post();
		$this->view->post = $Post->findBy('idPost',$comment['idPost']);

		
		if ($this->data && $Comment->isNew() == FALSE) {
			$Comment->prepareFromArray($this->data);

			if($Comment->save()){
				$this->message->addMessage("Comment updated.");
				$this->redirect("comments/");
			} else {
				$comment = $this->data;
			}
		}
		
		// Find status
		$status = new status();
		$statuses = $status->findAll(null, null, null, "WHERE idStatus = 1 or idStatus = 3");
		$this->view->statuses = $statuses;
		
		$this->view->comment = $comment;
		$this->title_for_layout($this->l10n->__("Edit comment - Codice CMS"));
		$this->render();
	}
	
	public function delete($id){
		$comment = new comment();
		$comment->find($id);
		$comment->delete();
		
		if($this->isAjax()){
			echo $id;
		}else{
			$this->redirect("comments");
		}
	}
	
	//A kind of update()
	public function approve($id){
		$Comment = new comment();
		$Comment->find($id);
		
		if($Comment['type'] == 'pingback' or $Comment['type'] == 'trackback'){
			$Comment->setPingback();
		}
		
		// Set status tu Publish
		$Comment['idStatus'] = 1; //'publish';
		$Comment->save();

		$this->registry->lastCommentID = $id;
		$this->plugin->call("comment_approbed");
		
		if($this->isAjax()){
			echo $id;
		}else{
			$this->redirect("comments");
		}
	}
        
    public function waiting(){
        $this->title_for_layout($this->l10n->__("Comentarios - Codice CMS"));

		$comment = new comment();
		// Find comments waiting for approval
		$comments = $comment->findAll(NULL, "idComment ASC", null, "WHERE idStatus = 3");
        foreach($comments as $key => $value){
			$Post = new post();
			$post = $Post->find($value['idPost']);

			$value['post'] = array(
				'urlfriendly' => $post['urlfriendly'],
				'title' => $post['title']
			);

			$value["content"] = utils::htmlentities($value["content"]);
			$value["content"] = utils::nl2br($value["content"]);
			
			// status
			$status = new status();
			$status->find($value['idStatus']);
			$value['status'] = $status['name'];
			
			$comments[$key] = $value;
		}
		
//		$this->registry->comments = $comments;
		
//		$this->plugin->call("comments_comment_content");
		$this->view->comments = $comments;
        $this->render();
    }
}
