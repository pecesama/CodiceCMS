<?php

abstract class appcontroller extends controller {

	protected $html;
	protected $plugin;
	protected $User;

	public function __construct(){
		parent::__construct();
		$this->registry = registry::getInstance();
		
		$this->html = html::getInstance();
		$this->plugin = plugin::getInstance();
		$this->User = new User_lib();
	}
}