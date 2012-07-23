<?php

abstract class appcontroller extends controller {

	protected $html;
	protected $plugin;
	protected $User;
	protected $config;

	public function __construct(){
		parent::__construct();
		$this->registry = registry::getInstance();
		
		$this->html = html::getInstance();
		$this->plugin = plugin::getInstance();
		$this->User = User_Lib::getInstance();

		//loads configuration of the logged user and blog.
		$C = new configuration();
		$this->config = array(
			"user" => $C->getUserConfiguration(1),
			"blog" => $C->getBlogConfiguration()
		);

		$this->view->config = $this->config;
	}
}
