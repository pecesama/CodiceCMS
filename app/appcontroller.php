<?php

abstract class appcontroller extends controller {

	protected $html;
	protected $plugin;
	
	public function __construct(){
		parent::__construct();
		$this->registry = registry::getInstance();
		$this->html = html::getInstance();
		$this->plugin = plugin::getInstance();
	}
}