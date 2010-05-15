<?php

class index_controller extends appcontroller {

	private $conf;

	public function __construct() {
		parent::__construct();

		$this->plugin->call('index_init');

		$Config = new configuration();
		$config = $Config->getBlogConfiguration();

		if(utils::themeExists($config["blog_current_theme"]) === false){
			$Config->setConfiguration("blog_current_theme",$Config->getDefaultTheme());
		}
		
		$this->conf = $config;
		$this->registry->conf = $config;
		$this->themes->conf = $config;
	}

	public function __call($method, $args){
		$page = (int)$args[0];
		if ($method == 'page' and isset($args[0])) {
			if ($page == 1) {
				$this->redirect("");
			}
			$this->index(NULL, $page);
		}
	}

	public function index($id=NULL, $page=1){

		$this->plugin->call('index_load');	
	
		$page = (int) (is_null($page)) ? 1 : $page ;

		$post = new post();
		$link = new link();
		$comment = new comment();

		$this->html->useTheme($this->conf['blog_current_theme']);

		$info = array();
		$info["isAdmin"] = false;
		if($this->cookie->check("logged") and $this->cookie->id_user == 1){
			$info["isAdmin"] = true;
		}

		$this->themes->info = $info;

		$includes['charset'] = $this->html->charsetTag("UTF-8");
		$includes['rssFeed'] = $this->html->includeRSS();

		if($page>1){
			$includes['canonical'] = $this->html->includeCanonical("/index/page/$page");
		}else if(rawurlencode($post->sql_escape($id))){
			$includes['canonical'] = $this->html->includeCanonical(rawurlencode($post->sql_escape($id)));
		}else{
			$includes['canonical'] = $this->html->includeCanonical();
		}

		$this->registry->includes = $includes;
		$this->plugin->call('index_includes');

		$includes = null;
		foreach($this->registry->includes as $include){
			$includes .= $include;
		}
		$this->themes->includes = $includes;

		$this->themes->links = $link->findAll();
		$single = ($id) ? true : false;
		if($id){
			if($info["isAdmin"]){
				$post_content = $post->findAll('*',null,1,"WHERE urlfriendly='".rawurlencode($post->sql_escape($id))."' AND (status='publish' OR status='draft')");
			}else{
				$post_content = $post->findAll('*',null,1,"WHERE urlfriendly='".rawurlencode($post->sql_escape($id))."' AND status='publish'");
			}

			if($post_content){
				if($post_content[0]['title']){
					$post_content[0]['title'] = htmlspecialchars($post_content[0]['title']);
				}else{
					$post_content[0]['title'] = "Untitled";
				}

				$post_content[0]['tags'] = $post->getTags($post_content[0]['ID']);

				$this->registry->posts = $post_content;
				$this->plugin->call("index_post_content");
				$this->themes->post = $this->registry->posts[0];
				
				$this->themes->title_for_layout = $this->registry->posts[0]['title'];

				//Si está autentificado, extraemos todos los comentarios.
				if($this->session->check("logged") === true) {
					$this->themes->comments_count = $comment->countCommentsByPost($post_content[0]['ID']);					
					$comments = $comment->findAll('comments.*, md5(comments.email) as md5_email','created',NULL,"WHERE ID_post={$post_content[0]['ID']}");
				}else{
					//Si no, sólo los aprobados o en estado "publish".
					$this->themes->comments_count = $comment->countCommentsByPost($post_content[0]['ID'],"publish");					
					$comments = $comment->findAll('comments.*, md5(comments.email) as md5_email','created',NULL,"WHERE ID_post={$post_content[0]['ID']} AND status='publish'");
				}

				foreach($comments as $k=>$comment){
					$comment['content'] = utils::htmlentities($comment['content']);
					$comment['content'] = utils::nl2br($comment['content']);
					$comments[$k] = $comment;
				}

				$this->themes->cookie = array(
					'author' => $this->cookie->check('author')?$this->cookie->author:'',
					'email' => $this->cookie->check('email')?$this->cookie->email:'',
					'url' => $this->cookie->check('url')?$this->cookie->url:'',
				);

				$this->registry->comments = $comments;
				$this->plugin->call("index_comment_content");
				$this->themes->comments = $this->registry->comments;
				
				$this->themes->id = $post_content[0]['ID'];
			} else {
				//buscar
				$single = false;

				$this->themes->title_for_layout = "Búsquedas";
				$this->themes->busqueda = strip_tags($id);
				$this->themes->pagination = "";

				$posts = $this->themes->searches = $post->findAll("urlfriendly,title,match(title, content, urlfriendly) against('".$post->sql_escape($id)."') as score","score DESC",20,"WHERE status='publish' AND match(title, content, urlfriendly) against('".$post->sql_escape($id)."')");
				$this->themes->posts = $posts;
			}
		}else{
			$total_rows = $post->countPosts();
			$limit = $this->conf['blog_posts_per_page'];
			$offset = (($page-1) * $limit);
			$limitQuery = $offset.",".$limit;
			$targetpage = $this->path.'index/page/';
			
			$this->themes->pagination = $this->pagination->init($total_rows, $page, $limit, $targetpage);
			
			if($info["isAdmin"]){
				$posts = $post->findAll("ID,id_user,urlfriendly,title,IF(POSITION('<!--more-->' IN content)>0,MID(content,1,POSITION('<!--more-->' IN content)-1),content) as content, created",'ID DESC',$limitQuery,"WHERE (status='publish' OR status='draft')");
			}else{
				$posts = $post->findAll("ID,id_user,urlfriendly,title,IF(POSITION('<!--more-->' IN content)>0,MID(content,1,POSITION('<!--more-->' IN content)-1),content) as content, created",'ID DESC',$limitQuery,"WHERE status='publish'");
			}

			foreach($posts as $k=>$p){
				$posts[$k]['title'] = htmlspecialchars($p['title']);
				$posts[$k]['tags'] = $post->getTags($posts[$k]['ID']);

				$posts[$k]['comments_count'] = $comment->countCommentsByPost($posts[$k]['ID'],"publish");

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
		}

		$this->themes->single = $single;
		$this->registry->single = $single;

		if(!$single) $this->themes->title_for_layout = $this->conf['blog_name'];

		$this->render();
	}
	
	public function addComment($id=null){
		if($_SERVER["REQUEST_METHOD"]=="POST"){
			if(is_null($id))
				$this->redirect($this->conf->blog_siteurl, false);
			
			$id = (int) $id;
			
			if($this->cookie->check('id_user')){
				$_POST['user_id'] = $this->cookie->id_user;
				$_POST['status'] = 'publish';
			}else{
				$_POST['user_id'] = 0;
				$_POST['status'] = 'waiting';
			}

			$_POST['type'] = '';//'pingback', 'trackback', ''

			$_POST['IP'] = utils::getIP();
			$_POST['ID_post'] = $id;

			$this->cookie->author = $_POST['author'];
			$this->cookie->email = $_POST['email'];
			$this->cookie->url = $_POST['url'];

			$comment = new comment();
			$comment->prepareFromArray($_POST);
			$valid = $comment->save();
			
			if($valid){
				$this->registry->lastCommentID = $valid;
				$this->registry->postID = $id;
				$this->plugin->call("index_comment_added");
			}
			
			$post = new post();
			$p = $post->findBy('ID',$id);
			
			if($valid and $this->isAjax()){
				echo $valid;
			}else if($valid){
				$this->redirect("{$p['urlfriendly']}#comment-{$valid}");
			}else{
				$this->redirect("{$p['urlfriendly']}");
			}
		}
	}

}