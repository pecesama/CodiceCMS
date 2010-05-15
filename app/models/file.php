<?php
/**
*  file
*/

class file extends models {
	
	private $config;
	
	public function __construct(){
		parent::__construct();
		$config = new configuration();
		$this->config = $config->getBlogConfiguration();
	}
	
	public function isDuplicated($name = null){
		$f = new file();
		$f->findBy('name',$name);
		return $f->exists();
	}
	
	public function exists(){
		// no se porque no funciona empty($this->name);
		return ($this->name != '');
	}
	
	public function getFullPath(){
		if(!empty($this->url)){
			return $this->config['blog_upload_folder'].'/'.$this->url;
		}
	}
	
	public function touch(){
		$this->last_access = date("Y-m-d H:i:s",strtotime("now"));
		$this->count++;
		$this->update();
	}
}