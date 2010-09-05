<?php
class plugins extends singleton{

	protected $registry;

	public function __construct(){
		$this->registry = registry::getInstance();
	}

	public function addAction($name, $function){
	
		$actions = $this->registry->plugins;
		$actions['actions'][$name][] = $function;
		
		$this->registry->modify('plugins',$actions);
		
	}
	
}
