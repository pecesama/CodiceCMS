<?php
/**
* RelTag model
*/
class RelTag extends models {

	public function updateRel($idPost, $rawTags){
		if(get_magic_quotes_gpc())
			$rawTags = stripslashes($rawTags);

		// Extrayendo Etiquetas que estan entre "tag" o 'tag'.		
		$rawTags = preg_replace('/\s+?/',' ',$rawTags);		
		$tags_regexp = '/[\"\']((?:[^\S]|[\s\w])+?)[\"\']/';
		preg_match_all($tags_regexp,$rawTags,$tags);
		$rawTags = preg_replace($tags_regexp,'',$rawTags);
		unset($tags[0]);
		$tags = $tags[1];

		// Extraemos el resto de tags separados por espacios.
		$tags = array_merge($tags,array_unique(explode(' ',$rawTags)));
		unset($rawTags);
		
		// Eliminar las relaciones actuales
		$this->db->query("DELETE FROM rel_tags WHERE idPost = '{$idPost}'");

		// Actualizamos tags para el $post_id pasado como parametro.
		// $tags contiene todos los tags que se relacionaran con la entrada actual.
		foreach($tags as $tag){
			if($tag != ''){
				$tag = $this->sql_escape($tag);

				// Actualiza el registro de tags
				$tagObject = new Tag();
				$urlFriendly = Url::build($tag);
				$tagObject->findBy('urlfriendly', $urlFriendly);
				$tagObject['urlfriendly'] = $urlFriendly;
				$tagObject['tag'] = $tag;

				// Si se guarda el registro
				if($tagObject->save()){
					// Relacionar la tag con el post
					$this->db->query("INSERT INTO rel_tags(idPost,idTag) VALUES ($idPost,{$tagObject['idTag']})");
				}
				
			}
		}
	}
}
?>