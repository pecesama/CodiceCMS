<?php

class appviews extends views {

	protected $User;

	public function __construct() {
		parent::__construct();
		$this->User = User_lib::getInstance();
	}
	
}