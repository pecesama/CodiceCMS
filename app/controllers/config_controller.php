<?php

class Config_controller extends AppController{
	
	public function __construct(){
		parent::__construct();

		if($this->User->isLogged() === FALSE){
			$this->redirect("login");
		}
	}

	public function index($id = null){
		if($this->data){
			$C = new configuration();
			
			foreach($this->data as $name => $value){
				if($C->findBy("name", $name)){
					//updating
					$C['value'] = trim($value);
					$C->save();
				}else{
					//adding new record.
					$C = new configuration();
					
					$new_value = array();
					$new_value['name'] = $name;
					$new_value['value'] = $value;
					$new_value['id_user'] = 1;
					
					$C->prepareFromArray($new_value);
					$C->save();
				}
			}
			
			$this->redirect("admin/config");
		}
		
		$this->registry->conf = $this->blogConfig;
		$this->registry->userConf = $this->userConf;
		$this->plugin->call('admin_init_config');

		$this->view->conf = $this->registry->conf;
		$this->view->userConf = $this->registry->userConf;
		
		$this->view->setLayout("admin");
		$this->render();
	}
}