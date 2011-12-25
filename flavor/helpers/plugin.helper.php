<?php
class plugin extends singleton{
	public static function getInstance() {
		return parent::getInstance(get_class());
	}

	private $plugins = array(
		'instances' => array(), //instancias
		'actions' => array(),	//calls
		'exists' => array(),		//
		'plugins' => array()		//lista de plugins en la carpeta plugins
	);
	
	public function __construct(){
		$this->registry = registry::getInstance();
		$this->registry->plugins = $this->plugins;
		$this->init_plugins();
	}

	function init_plugins(){
            
            // Validate the folder of pligins exist
            if(file_exists(Absolute_Path.'app/plugins')){
                if ($gestor = opendir(Absolute_Path.'app/plugins')){
			$plugins = array();
			while (false !== ($archivo = readdir($gestor))) {
				if(preg_match('/^([\w]+)\.plugin\.php$/',$archivo,$out)){
					$plugins[] = $out[1];
				}
			}
			$this->registry->modify('plugins',array('plugins'=>$plugins));
		}
		closedir($gestor);
            }
		
	
		$plugins = $this->registry->plugins['plugins'];
		
		if(count($plugins) > 0){
			foreach ($plugins as $index => $plugin){			
				if (!file_exists(Absolute_Path."app".DIRSEP."plugins".DIRSEP."$plugin.plugin.php")) {
					unset($this->plugins->plugins[$index]);
					continue;
				}else{
					$file = Absolute_Path.'app'.DIRSEP.'plugins'.DIRSEP.$plugin.'.plugin.php';
					require_once($file);
				}
	  
				if (!class_exists($plugin)) {
					continue;
				}

				$this->plugins['instances'][$plugin] = new $plugin;
			}
		}
	}
	
	public function call($name){
		if (!$this->exists($name)) {
			return false;
		}
		$index = 0;
		foreach ($this->plugins['instances'] as $plugin) {
			if(array_key_exists($index,$this->registry->plugins['actions'][$name])){
				foreach($this->registry->plugins['actions'][$name] as $action){
					if (is_callable(array($plugin, $action))) {
						$plugin->$action();
						$index++;
					}
				}
			}
		}
	}
	
	private function exists($name){
		if (isset($this->plugins['exists'][$name])) {
			return $this->plugins['exists'][$name];
		}

		foreach ($this->plugins['instances'] as $plugin){
			if(array_key_exists($name,$this->registry->plugins['actions'])){
				if (is_callable(array($plugin, $this->registry->plugins['actions'][$name][0]))) {
					return $this->plugins['exists'][$name] = true;
				}
			}
		}

		return $this->plugins['exists'][$name] = false;
	}
}
