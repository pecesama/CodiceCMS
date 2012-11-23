<?php

class AppViews extends Views {

	protected $User;
	protected $messages;

	public function __construct() {
		parent::__construct();
		$this->messages = Message::getInstance();
		$this->User = User_Lib::getInstance();
	}
	
}