<?php

class appviews extends views {

	protected $User;
        protected $messages;

	public function __construct() {
            parent::__construct();
            $this->messages = Message::getInstance();
            $this->User = User_Lib::getInstance();
	}
	
}
