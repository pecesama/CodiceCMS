<?php

class feed_controller extends appcontroller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index($id=NULL) {
		$this->redirect('feed/rss');
	}
	
	public function rss($id=NULL){
		$this->plugin->call('feed_header');
		
		$post = new post();

		$this->view->setLayout("feed");
		$posts = $post->findAll("idPost,urlfriendly,title,IF(POSITION('<!--more-->' IN content)>0,MID(content,1,POSITION('<!--more-->' IN content)-1),content) as content, created", "idPost DESC", $this->config["blog"]['blog_posts_per_page'], "WHERE idStatus = '1'");
		$temp = array();
		foreach($posts as $a_post){
			$temp[$a_post['idPost']] = $a_post;
			$temp[$a_post['idPost']]['tags'] = $post->getTags($a_post['idPost'],'string');
		}
		$this->view->posts = $temp;
		
		// Get configuration
/*		$configuration = new configuration();
		$this->view->conf = $configuration->findAll();
	*/

		
		$this->render("rss");
	}
}
