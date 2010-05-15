<?php
class configuration extends models{
	
	public function getBlogConfiguration(){
		$sql = "SELECT * FROM configurations WHERE name LIKE 'blog_%' AND id_user = 1";
		
		$rows = $this->findAllBySql($sql);
		
		$configuration = array();
		foreach($rows as $row){
			$configuration[$row['name']] = $row['value'];
		}

		return $configuration;
	}
	
	public function getUserConfiguration($id = 1){
		$sql = "SELECT * FROM configurations WHERE name NOT LIKE 'blog_%' and id_user = $id";
		
		$rows = $this->findAllBySql($sql);
		
		$configuration = array();
		foreach($rows as $row){
			$configuration[$row['name']] = $row['value'];
		}
		
		return $configuration;
	}
	
	public function setConfiguration($name,$value){
		$C = new configuration();
		$conf = $C->findBy("name",$name);
		
		if($C->isNew() === true){
			return false;
		}
		
		$conf["value"] = $value;
		$C->prepareFromArray($conf);
		$C->save();
		return true;
	}
	
	public function getDefaultTheme(){
		/*
		 * Si no existiera el default, debería regresar el que exista.
		 */
		return "stan512";
	}
}