<?php
class feedburner extends plugins {

	public function __construct(){
		parent::__construct();
		
		define('VALID_URL','/^(http|https):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}((:[0-9]{1,5})?\/.*)?$/i');
	
		$this->addAction('index_includes','replaceFeed');
		$this->addAction('feed_header','feedRedirect');
		$this->addAction('admin_init_config', 'addControlPanelOption');
		$this->addAction('admin_init','checkConfig');
	}

	public function replaceFeed(){	
		$includes = $this->registry->includes;
		
		if(isset($this->registry->conf['blog_feedburner_rssLink'])){
			$rssLink = $this->registry->conf['blog_feedburner_rssLink'];
			$rss = "<link rel=\"alternate\" type=\"application/rss+xml\" title=\"RSS 2.0\" href=\"{$rssLink}\" />\n";		
			$includes['rssFeed'] = $rss;
			$this->registry->modify('includes',$includes);
		}
	}

	public function feedRedirect(){
		$Conf = new configuration();
		if($row = $Conf->findBy('name','blog_feedburner_rssLink')){
			$rssLink = $row['value'];
		
			if(preg_match(VALID_URL,$rssLink)){
				if (!preg_match("/feedburner|feedvalidator/i", $_SERVER['HTTP_USER_AGENT'])){
					header("Location: {$rssLink}");
					header("HTTP/1.1 302 Temporary Redirect");
					exit;
				}
			}
		}
	}
	
	function addControlPanelOption() {
		$conf = $this->registry->conf;		
		$conf['blog_feedburner_rssLink'] = isset($conf['blog_feedburner_rssLink']) ? $conf['blog_feedburner_rssLink'] : null;
		$this->registry->modify('conf', $conf);
	}

	function checkConfig(){
		$this->cookie = cookie::getInstance();
		if(!$this->cookie->check("logged")){
			return;
		}

		$conf = new configuration();
		$row = $conf->findBy('name','blog_feedburner_rssLink');

		$setupMsg = "<p style=\"border:1px solid #f00;background-color:#ff0;padding:10px;font-size:15px;\">Please <a href=\"{$this->registry->path}admin/config#blog_feedburner_rssLink\">setup</a> the feedburner plugin.</p>";

		if(!$row){
			echo $setupMsg;
		}else{
			if(!preg_match(VALID_URL,$row['value'])){
				echo $setupMsg;
			}
		}
	}
}