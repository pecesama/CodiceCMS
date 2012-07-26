<?php
class configuration extends models{
	
	public function findLast(){
		return $this->findBySql("SELECT * FROM configurations ORDER BY idConfiguration DESC LIMIT 1");
	}
	
	public function getBlogConfiguration(){
		$sql = "SELECT * FROM configurations WHERE name LIKE 'blog_%' AND idUser = 1";

		$rows = $this->findAllBySql($sql);
		
		$configuration = array();
		foreach($rows as $row){
			$configuration[$row['name']] = $row['value'];
		}

		return $configuration;
	}
	
	public function getUserConfiguration($id = 1){
		$sql = "SELECT * FROM configurations WHERE name NOT LIKE 'blog_%' and idUser = $id";
		
		$rows = $this->findAllBySql($sql);
		
		$configuration = array();
		foreach($rows as $row){
			$configuration[$row['name']] = $row['value'];
		}
		
		return $configuration;
	}
}
