<?php

abstract class appcontroller extends controller {

	protected $html;
	protected $plugin;
	protected $User;
	protected $config;
        protected $messages;

	public function __construct($checkLogin = true){
		parent::__construct();
       	
       	$this->messages = Message::getInstance();
                
		$this->registry = registry::getInstance();
		
		$this->html = html::getInstance();
		$this->plugin = plugin::getInstance();
		$this->User = User_Lib::getInstance();

		// Check login
		if($checkLogin){
			if($this->User->isLogged() === FALSE){
				$this->redirect("login");
			}
		}

		//loads configuration of the logged user and blog.
		$C = new configuration();
		$this->config = $C->findLast();

		$this->view->config = $this->config;
	}
}
