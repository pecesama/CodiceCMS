<?php

class debug extends plugins {   

	function __construct(){
		parent::__construct();
		$this->registry = registry::getInstance();
		
		$this->addAction('index_init', 'init');
		$this->addAction('index_load', 'addToolbar');
	}
	
	public function init(){
		$action = isset($_GET['action'])?$_GET['action']:'';
		switch($action){
			case 'create_tables': $this->create_tables(); break;
			case 'delete_tables': $this->delete_tables(); break;
			case 'generate_configurations': $this->generate_configurations(); break;
			case 'delete_configurations': $this->delete_configurations(); break;
			case 'add_posts': $this->add_posts(); break;
			case 'delete_posts': $this->delete_posts(); break;
			case 'add_tags': $this->add_tags(); break;
			case 'delete_tables': $this->delete_tables(); break;
			case 'add_comments': $this->add_comments(); break;
			case 'delete_commentss': $this->delete_comments(); break;
		}
	}
	
	public function addToolbar(){
	?>
		<style>
			div.toolbar{
				background-color:yellow;
				padding:5px;
			}
		</style>
		<div class="toolbar">
			<h1>DEBUG MODE</h1>
			<ul>
				<li><a href="?action=create_tables">Create tables</a></li>
				<li><a href="?action=delete_tables">Delete tables</a></li>
				<li><a href="?action=generate_configurations">Generate Configurations</a></li>
				<li><a href="?action=delete_configurations">Delete Configurations</a></li>
				<li><a href="?action=add_posts">Add Posts</a></li>
				<li><a href="?action=delete_posts">Delete Posts</a></li>
				<li><a href="?action=add_tags">Add Tags</a></li>
				<li><a href="?action=delete_tables">Delete Tags</a></li>
				<li><a href="?action=add_comments">Add comments</a></li>
				<li><a href="?action=delete_comments">Delete comments</a></li>
			</ul>
		</div>
	<?php
	}
	
	public function delete_tables(){
		$M = mysqli_db::getInstance();
		$sqls = array();
		
		$sqls[] = "DROP TABLE IF EXISTS `comments`;";
		$sqls[] = "DROP TABLE IF EXISTS `configurations`;";
		$sqls[] = "DROP TABLE IF EXISTS `files`;";
		$sqls[] = "DROP TABLE IF EXISTS `links`;";
		$sqls[] = "DROP TABLE IF EXISTS `posts`;";
		$sqls[] = "DROP TABLE IF EXISTS `tags`;";
		$sqls[] = "DROP TABLE IF EXISTS `tags_rel`;";
		$sqls[] = "DROP TABLE IF EXISTS `users`;";
		
		foreach($sqls as $sql){
			$M->query($sql);
		}
	}
	
	public function create_tables(){
		$this->delete_tables();
		
		$M = mysqli_db::getInstance();
		
		$sqls = array();
		
		$sqls[] = "CREATE TABLE IF NOT EXISTS `comments` (
  `suscribe` varchar(255) default NULL,
  `user_id` varchar(255) default NULL,
  `type` varchar(255) default NULL,
  `status` varchar(255) default NULL,
  `content` text,
  `IP` varchar(255) default NULL,
  `url` varchar(255) default NULL,
  `email` varchar(255) default NULL,
  `author` varchar(255) default NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `ID_post` int(10) unsigned NOT NULL,
  `ID` int(10) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
";
		$sqls[] = "CREATE TABLE IF NOT EXISTS `configurations` (
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
		
		$sqls[] = "CREATE TABLE IF NOT EXISTS `files` (
  `id_file` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `hotlink` int(1) NOT NULL,
  `last_access` datetime NOT NULL default '0000-00-00 00:00:00',
  `count` int(11) NOT NULL default '0',
  `stats` int(1) NOT NULL,
  `url` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY  (`id_file`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
		
		$sqls[] = "CREATE TABLE IF NOT EXISTS `links` (
  `name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `type` varchar(15) character set utf8 collate utf8_bin NOT NULL default 'external',
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `ID` int(10) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
		
		$sqls[] = "CREATE TABLE IF NOT EXISTS `posts` (
  `urlfriendly` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text,
  `status` varchar(50) default NULL,
  `ID` int(10) unsigned NOT NULL auto_increment,
  `id_user` int(11) NOT NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`ID`),
  FULLTEXT KEY `title` (`title`,`content`,`urlfriendly`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
		
		$sqls[] = "CREATE TABLE IF NOT EXISTS `tags` (
  `tag_id` int(11) NOT NULL auto_increment,
  `tag` varchar(255) NOT NULL,
  `urlfriendly` varchar(255) NOT NULL,
  PRIMARY KEY  (`tag_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
		
		$sqls[] = "CREATE TABLE IF NOT EXISTS `tags_rel` (
  `tag_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
		
		$sqls[] = "CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(100) default NULL,
  `login` varchar(100) NOT NULL default '',
  `password` varchar(64) NOT NULL default '',
  `email` varchar(100) default NULL,
  `website` varchar(150) default NULL,
  `about` text,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
		
		foreach($sqls as $sql){
			$M->query($sql);
		}
	}
	
	public function generate_configurations(){
		$this->delete_configurations();
		$M = mysqli_db::getInstance();
		
		$sql = "INSERT INTO `configurations` (`name`, `value`, `id_user`, `id`) VALUES
('blog_name', 'Codice CMS', 1, 1),
('blog_description', 'Content management made easy', 1, 2),
('blog_siteurl', 'http://localhost/CodiceCMS', 1, 3),
('blog_current_theme', 'misalgoritmos', 1, 4),
('blog_posts_per_page', '3', 1, 5),
('posts_per_page', '15', 1, 6),
('blog_feedburner_rssLink', 'http://feeds2.feedburner.com/misalgoritmos', 1, 7),
('blog_upload_folder', 'uploads', 1, 8);";
		
		$M->query($sql);
	}
	
	public function delete_configurations(){
		$M = mysqli_db::getInstance();
		
		$sql = "TRUNCATE TABLE `configurations`";
		
		$M->query($sql);
	}
	
	public function add_posts(){
	
	}
	
	public function delete_posts(){
	
	}
	
	public function add_tags(){
	
	}
	
	public function delete_tags(){
	
	}
	
	public function add_comments(){
	
	}
	
	public function delete_comments(){
	
	}
}
