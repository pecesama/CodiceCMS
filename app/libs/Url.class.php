<?php
/**
* Url class
*/
class Url{
	
	/*
	 * Genera un url amigable a partir de una cadena de texto
	 * Function aVictorada De la Rocheada. /LaOnda
	 * Use bajo su propio riesgo.
	 */
	public static function build($text, $postffix = null){
		$text = str_replace('-',' ',$text);
		$a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ ¡?_.';
		$b = 'AAAAAAACEEEEIIIIDNOOOOOOUUUUYbsaaaaaaaceeeeiiiidnoooooouuuyybyRr     ';
		$text = strtr(utf8_decode($text), utf8_decode($a), $b);
		$text = trim($text); //sin espacios a los extremos.
		$values = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
							'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z',
							'1','2','3','4','5','6','7','8','9','0',
							' ','-');
		$out = '';
		$len = strlen($text);
		for($chr=0;$chr<=$len-1;$chr++){
			if(in_array($text[$chr],$values,true))
				$out.= $text[$chr];
		}

		$out = preg_replace('/ +/','-',$out); //reduce todos espacios repetidos a uno solo.

		// $c=0;
		// if($validateExists){
		// 	#Check if this urlFriendly exists on table posts
		// 	do{ 
		// 		++$c;
		// 		/*
		// 		 * id se utilizar para evitar compare con el mismo registro y agregue _2 al final.
		// 		 */
		// 		if($id)
		// 		$this->db->query("SELECT urlFriendly FROM posts WHERE urlFriendly='$out".($c>1?"_$c":'')."' and idPost<>$id");
		// 			else
		// 		$this->db->query("SELECT urlFriendly FROM posts WHERE urlFriendly='$out".($c>1?"_$c":'')."'");
		// 	}while($this->db->fetchRow());
		// }
		
		return $out.($postffix?"$postffix":'');
		//$urlFriendly = $out.($postffix?"_$postffix":'');
		
		//return $urlFriendly;
	}
}
?>