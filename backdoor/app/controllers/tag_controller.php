<?php

class tag_controller extends appcontroller {
	
	public function __construct() {
		parent::__construct();
		
		$this->plugin->call('codice_init');
	}
	
	public function __call($method, $args){
		$page = (int) (isset($args[0])?$args[0]:1);
		if($page)
			$this->index($method, $page);
		else
			$this->redirect($this->config["blog"]['blog_siteurl']);
	}
	
	public function index($id=NULL, $page=1){
		if(is_null($id) or is_numeric($id))
			$this->redirect($this->config["blog"]['blog_siteurl']);
		
		$tag = $id;
		
		$post = new post();
		$link = new link();
		$comment = new comment();

		$this->html->useTheme($this->config["blog"]['blog_current_theme']);

		$info = array();
		$info["isAdmin"] = false;
		if($this->cookie->check("logged") and $this->cookie->id_user == 1){
			$info["isAdmin"] = true;
		}

		$this->themes->info = $info;

		$includes['charset'] = $this->html->charsetTag("UTF-8");
		$includes['rssFeed'] = $this->html->includeRSS();

		if($page>1){
			$includes['canonical'] = "<link rel=\"canonical\" href=\"{$this->config["blog"]['blog_siteurl']}/tag/".rawurlencode($post->sql_escape($id))."/$page\" />";
		}else{
			$includes['canonical'] = "<link rel=\"canonical\" href=\"{$this->config["blog"]['blog_siteurl']}/tag/".rawurlencode($post->sql_escape($id))."\" />";
		}

		$this->registry->includes = $includes;
		$this->plugin->call('index_includes');

		$includes = null;
		foreach($this->registry->includes as $include){
			$includes .= $include;
		}
		$this->themes->includes = $includes;

		$this->themes->links = $link->findAll();
		$this->themes->single = false;
		$total_rows = $post->countPosts(array('status'=>'publish','tag'=>$tag));

		$page = (int) (is_null($page)) ? 1 : $page;
		$limit = $this->config["blog"]['blog_posts_per_page'];
		$offset = (($page-1) * $limit);
		$limitQuery = $offset.",".$limit;
		$targetpage = $this->path."tag/$tag/";

		$this->themes->pagination = $this->pagination->init($total_rows, $page, $limit, $targetpage);

		$posts = $post->getPostsByTag($tag,$limitQuery);

		foreach($posts as $k=>$p){
			$posts[$k]['title'] = htmlspecialchars($p['title']);
			$posts[$k]['tags'] = $post->getTags($p['ID']);
			$posts[$k]['comments_count'] = $comment->countCommentsByPost($posts[$k]['ID']);

			$user = new user();
			if($posts[$k]['id_user']<2){
				$posts[$k]['autor'] = $user->find(1);
			}else{
				$posts[$k]['autor'] = $user->find($posts[$k]['id_user']);
			}
		}

		$this->registry->posts = $posts;
		$this->plugin->call("index_post_content");
		$this->themes->posts = $this->registry->posts;

		$this->themes->title_for_layout = "{$this->config["blog"]['blog_name']} - $tag";

		$this->render();
	}
}
