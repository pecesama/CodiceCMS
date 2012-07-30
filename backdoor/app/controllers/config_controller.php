<?php

class Config_controller extends appcontroller{
	
	public function __construct(){
		parent::__construct();
	}

	public function index($id = null){

		$config = $this->config;
		if($this->data){
			$C = new configuration();
			$C->prepareFromArray($this->data);
			$C->idUser = $this->session->user['idUser'];
			if($C->save()){
				$this->messages->addMessage(Message::SUCCESS, "Configuración guardada.");
				$this->redirect("config/");
			} else {
				$this->messages->addMessage(Message::ERROR, "ERROR al guardar la configuración.");
				$config = $this->data;
			}
		}
		
		$this->registry->conf = $config;
//		$this->registry->userConf = $this->userConf;
		$this->plugin->call('admin_init_config');

		$this->view->conf = $this->registry->conf;
//		$this->view->userConf = $this->registry->userConf;
		
//		$this->view->setLayout("admin");
		$this->title_for_layout('Codice CMS - Configuration');
		$this->render();
	}
}