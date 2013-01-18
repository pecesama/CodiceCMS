<?php

abstract class AppController extends Controller {

	protected $html;
	protected $plugin;
	protected $User;
	protected $config;
    protected $messages;

	public function __construct(){
		parent::__construct();
                
                $this->messages = Message::getInstance();
                
		$this->registry = Registry::getInstance();
		
		$this->html = Html::getInstance();
		$this->plugin = Plugin::getInstance();
		$this->User = User_Lib::getInstance();

		//loads configuration of the logged user and blog.
		$C = new Configuration();
		$this->config = $C->findLast();

		$this->view->config = $this->config;
	}
}
