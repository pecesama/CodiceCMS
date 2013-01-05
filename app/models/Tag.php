<?php
/**
* Tag model
*/
class Tag extends models {
	
	public function getByPost($idPost){
		$sql = "SELECT * FROM rel_tags
				INNER JOIN tags ON rel_tags.idTag = tags.idTag
				WHERE idPost = '$idPost'";

		return $this->findAllBySql($sql);
	}

	public static function toString(array $tags){
		$out = null;
		foreach($tags as $tag)
			$out .= strpos($tag['tag'],' ')?"\"{$tag['tag']}\" ":$tag['tag'].' ';
		return $out;
	}
}
?>