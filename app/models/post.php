<?php

class post extends models{

	public function countPosts($extra = array('status'=>'Publish','tag'=>null)){
		$sql = "select count(*) as total from posts as p ";
		//status
		  $sql .= $extra['status']?"inner join statuses as s on s.idStatus = p.idStatus ":null;
		//tags
		  $sql .= $extra['tag']?"inner join rel_tags as rt on rt.idPost = p.idPost ":null;
		  $sql .= $extra['tag']?"inner join tags as t on t.idTag = rt.idTag ":null;
		$sql .= "where 1=1 ";
		  $sql .= $extra['status']?"AND s.name = '".$this->sql_escape($extra['status'])." ' ":null;
		  $sql .= $extra['tag']?"AND t.urlfriendly = '".$this->sql_escape($extra['tag'])." ' ":null;

		$valid = $this->findBySql($sql);
		
		if(empty($valid) == false){
			return $valid['total'];
		}else{
			return 0;			
		}
	}

	public function busqueda($q){
		$P = new post();
		
		$q = $P->sql_escape($q);
		
		$rows = $P->findAll(
			"urlfriendly,title,match(title, content, urlfriendly) against('$q') as score",
			"score DESC",
			20,
			"WHERE status='Publish' AND match(title, content, urlfriendly) against('$q')"
		);
		
		return $rows;
	}

	public function getPosts($status = null, $limitQuery = null){
		$P = new post();
		$posts = array();

		if(is_null($status) === true){//1. Si no hay status
			$posts = $P->findAllBySql("SELECT 
			  p.idPost,p.idUser,p.urlfriendly,p.title,
			  IF(POSITION('<!--more-->' IN p.content)>0,MID(p.content,1,POSITION('<!--more-->' IN p.content)-1),p.content) as content,
			  p.created
			FROM posts as p
			ORDER BY p.idPost DESC LIMIT $limitQuery");

		}else if(is_array($status) === false){//2. Si hay un status (String).
			$posts = $P->findAllBySql("SELECT 
			  p.idPost,p.idUser,p.urlfriendly,p.title,
			  IF(POSITION('<!--more-->' IN p.content)>0,MID(p.content,1,POSITION('<!--more-->' IN p.content)-1),p.content) as content,
			  p.created
			FROM posts as p
			INNER JOIN statuses as s on s.idStatus = p.idStatus
			WHERE
			  s.name='$status'
			ORDER BY p.idPost DESC LIMIT $limitQuery");

		}else{//3. Si hay más de 1 status (debe ser un Array)
			$status_sql = "";
			foreach($status as $st){
				$status_sql .= "s.name ='$st' OR ";
			}
			$status_sql = substr($status_sql,0,-3);
			
			$posts = $P->findAllBySql("SELECT 
			  p.idPost,p.idUser,p.urlfriendly,p.title,
			  IF(POSITION('<!--more-->' IN p.content)>0,MID(p.content,1,POSITION('<!--more-->' IN p.content)-1),p.content) as content,
			  p.created
			FROM posts as p
			INNER JOIN statuses as s on s.idStatus = p.idStatus
			WHERE
			  ($status_sql)
			ORDER BY p.idPost DESC LIMIT $limitQuery");
		}

		$C = new comment();
		foreach($posts as $k=>$p){
			$posts[$k]['title'] = htmlspecialchars($posts[$k]['title']);
			$posts[$k]['tags'] = $this->getTags($posts[$k]['idPost']);
			
			//TODO: if it's admin logged, include too comments with "Waiting" status (waiting to be approved).
			$posts[$k]['comments_count'] = $C->countCommentsByPost($posts[$k]['idPost'],"Publish");
			
			$U = new user();
			if($posts[$k]['idUser'] < 2){
				$posts[$k]['autor'] = $U->find(1);
			}else{
				$posts[$k]['autor'] = $U->find($posts[$k]['idUser']);
			}
		}

		return $posts;
	}
	
	public function getPost($urlfriendly, $status = null){
		$urlfriendy = rawurlencode($this->sql_escape($urlfriendly));
		$post = array();
		
		exit( __FILE__ . " -> LINE: " . __LINE__ );

		if(is_null($status) === true){
			$post = $this->findBy(
				'urlfriendly',
				$urlfriendly
			);
		}else{
			$post = $this->findBy(
				array('urlfriendly','status'),
				array($urlfriendly,$status)
			);
		}

		exit;

		if($this->isNew() === false){
			if($post['title']){
				$post['title'] = htmlspecialchars($post['title']);
			}else{
				$post['title'] = "Untitled";
			}
			
			$post['tags'] = $this->getTags($post['ID']);
			
			$C = new comment();
			$post["comments_count"] = $C->countCommentsByPost($post['ID'],"Publish");
			$post["comments"] = $C->getAll($post['ID'],"Publish");
		}
		
		return $post;
	}
	
	/*
	 * Genera un url amigable a partir de una cadena de texto
	 * Function aVictorada De la Rocheada. /LaOnda
	 * Use bajo su propio riesgo.
	 */
	function buildUrl($name,$id=null,$validateExists=true){
		$name = str_replace('-',' ',$name);
		$a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ ¡?_.';
		$b = 'AAAAAAACEEEEIIIIDNOOOOOOUUUUYbsaaaaaaaceeeeiiiidnoooooouuuyybyRr     ';
		$name = strtr(utf8_decode($name), utf8_decode($a), $b);
		$name = trim($name); //sin espacios a los extremos.
		$values = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
							'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z',
							'1','2','3','4','5','6','7','8','9','0',
							' ','-');
		$out = '';
		$len = strlen($name);
		for($chr=0;$chr<=$len-1;$chr++){
				if(in_array($name[$chr],$values,true))
				$out.= $name[$chr];
			}

		$out = preg_replace('/ +/','-',$out); //reduce todos espacios repetidos a uno solo.

		$c=0;
		if($validateExists){
			#Check if this urlFriendly exists on table posts
			do{ 
				++$c;
				/*
				 * id se utilizar para evitar compare con el mismo registro y agregue _2 al final.
				 */
				if($id)
				$this->db->query("SELECT urlFriendly FROM posts WHERE urlFriendly='$out".($c>1?"_$c":'')."' and id<>$id");
					else
				$this->db->query("SELECT urlFriendly FROM posts WHERE urlFriendly='$out".($c>1?"_$c":'')."'");
			}while($this->db->fetchRow());
		}
		
		$urlFriendly = $out.($c>1?"_$c":'');
		
		return $urlFriendly;
	}
	
	public function getTags($post_id,$type=null){
		$post_id = (int) $post_id;

		$sql = "SELECT t.tag,t.urlfriendly \n";
		$sql .= "FROM tags as t \n";
			$sql .= "\tinner join rel_tags as tr on tr.idTag = t.idTag \n";
			$sql .= "\tinner join posts as p on p.idPost = tr.idPost \n";
		$sql .= "WHERE p.idPost = $post_id \n";
		$sql .= "ORDER BY t.tag";

		$this->db->query($sql);
		
		$tags = array();
		while($row = $this->db->fetchRow())
			$tags[] = $row; 
		
		if($type=='string'){
			$out = null;
			foreach($tags as $tag)
				$out .= strpos($tag['tag'],' ')?"\"{$tag['tag']}\" ":$tag['tag'].' ';
			return $out;
		}
		
		return $tags;
	}
	
	public function updateTags($post_id,$tags_raw=''){
		if(get_magic_quotes_gpc())
			$tags_raw = stripslashes($tags_raw);

		/* 
		 * Extrayendo Etiquetas que estan entre "tag" o 'tag'.
		 */
		$tags_raw = preg_replace('/\s+?/',' ',$tags_raw);		
		$tags_regexp = '/[\"\']((?:[^\S]|[\s\w])+?)[\"\']/';
		preg_match_all($tags_regexp,$tags_raw,$tags);
		$tags_raw = preg_replace($tags_regexp,'',$tags_raw);
		unset($tags[0]);
		$tags = $tags[1];

		/*
		 * Extraemos el resto de tags separados por espacios.
		 */		
		$tags = array_merge($tags,array_unique(explode(' ',$tags_raw)));
		unset($tags_raw);

		/*
		 * Actualizamos tags para el $post_id pasado como parametro.
		 * $tags contiene todos los tags que se relacionaran con la entrada actual.
		 */
		foreach($tags as $tag){
			if($tag != ''){
				$tag = $this->sql_escape($tag);

				$tag_id = $this->tagExists($tag);
				if($tag_id){
					#1.- Si no existe la relacion agregarla
					$this->db->query("select * from tags_rel where post_id=$post_id and tag_id=$tag_id");
					$row = $this->db->fetchRow();
					if(!$row)
						$this->db->query("insert into tags_rel(post_id,tag_id) values($post_id,$tag_id)");
				}else{
					$tag_id = $this->addTag($tag);
					$this->db->query("insert into tags_rel(post_id,tag_id) values($post_id,$tag_id)");
				}
			}
		}
	}
	
	public function tagExists($tag){
		$tag = $this->sql_escape($tag);
		$this->db->query("select * from tags as t where t.urlfriendly = '".$this->buildUrl($tag,null,false)."'"); 
		if($row = $this->db->fetchRow())
			return $row['tag_id'];
		return false;
	}
	
	public function addTag($tag){
		$tag = $this->sql_escape($tag);
		$this->db->query("insert into tags(tag,urlfriendly) values('".$tag."','".$this->buildUrl($tag,null,false)."')");
		return $this->db->lastId();
	}
	
	public function getPostsByTag($tag,$limitQuery){
		$tag = $this->sql_escape($tag);







		$sql = "SELECT \n";
			$sql .= "\tp.ID,p.id_user,p.urlfriendly,p.title,IF(POSITION('<!--more-->' IN p.content)>0,MID(p.content,1,POSITION('<!--more-->' IN p.content)-1),p.content) as content, created \n";
		$sql .= "FROM posts as p\n";
			$sql .= "\tinner join tags_rel as tr on tr.post_id = p.ID \n";
			$sql .= "\tinner join tags as t on t.tag_id = tr.tag_id \n";
		$sql .= "WHERE \n";
			$sql .= "\tp.status='Publish' and t.urlfriendly='$tag' \n";
		$sql .= "ORDER BY \n";
			$sql .= "\tID DESC\n";
		$sql .= "LIMIT \n";
			$sql .= "\t$limitQuery";
		
		$this->db->query($sql);

		$rows = array();
		while($row = $this->db->fetchRow()){
			$rows[] = $row;
		}
		return $rows;
	}
	
}