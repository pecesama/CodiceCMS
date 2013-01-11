<?php

class Post extends Models{

	/***
	 *  FIXME
	 *
	 */
	public function countPosts($extra = array('status'=>'Publish','tag'=>null)){
		$sql = "select count(*) as total from posts as p ";
		//status
		  $sql .= $extra['status']?"inner join statuses as s on s.idStatus = p.idStatus ":null;
		//tags
		  $sql .= $extra['tag']?"left join rel_tags as rt on rt.idPost = p.idPost ":null;
		  $sql .= $extra['tag']?"left join tags as t on t.idTag = rt.idTag ":null;
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
			"WHERE idStatus=1 AND match(title, content, urlfriendly) against('$q')"
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
		foreach($posts as $k => $post){
			$posts[$k]['title'] = htmlspecialchars($post['title']);

			$tag = new Tag();
			$posts[$k]['tags'] = $tag->getByPost($post['idPost']);
			
			//TODO: if it's admin logged, include too comments with "Waiting" status (waiting to be approved).
			$posts[$k]['comments_count'] = $C->countByPost($post['idPost'],"Publish");
			
			// Get autor
			$user = new user();
			$author = $user->find($post['idUser']);
			if($user->isNew() == TRUE){
				$author = array(
						'firstName' => "No",
						'lastName' => "Author"
					);
			}
			$posts[$k]['author'] = $author;
		}

		return $posts;
	}
	
	public function getPost($urlfriendly, $statusName = null){
		$urlfriendy = rawurlencode($this->sql_escape($urlfriendly));
		$post = array();
		
//		exit( __FILE__ . " -> LINE: " . __LINE__ );

		if(is_null($statusName) === true){
			$post = $this->findBy(
				'urlfriendly',
				$urlfriendly
			);
		}else{
			
			//
			$status = new status();
			$status->findBy('name', $statusName);
			$post = $this->findBy(
				array('urlfriendly', 'idStatus'),
				array($urlfriendly, $status['idStatus'])
			);
		}

//		exit;

		if($this->isNew() === false){
			if($post['title']){
				$post['title'] = htmlspecialchars($post['title']);
			}else{
				$post['title'] = "Untitled";
			}
			
			$tag = new Tag();
			$post['tags'] = $tag->getByPost($post['idPost']);
			
			$C = new comment();
			$post["comments_count"] = $C->countByPost($post['idPost'], 'Publish');
			$post["comments"] = $C->getAll($post['idPost'], $status['idStatus']);

			// Get autor
			$user = new user();
			$author = $user->find($post['idUser']);
			if($user->isNew() == TRUE){
				$author = array(
						'firstName' => "No",
						'lastName' => "Author"
					);
			}
			$post['author'] = $author;
		}
		
		return $post;
	}
	
	/*
	 * Genera un url amigable a partir de una cadena de texto
	 * Function aVictorada De la Rocheada. /LaOnda
	 * Use bajo su propio riesgo.
	 */
	function buildUrl($name,$id=null,$validateExists=true){
		
		$urlFriendly = Url::build($name);

		$c=0;
		if($validateExists){
			#Check if this urlFriendly exists on table posts
			do{ 
				
				// Generate next urlFriendly
				$out = $urlFriendly.($c>1?"_$c":'');

				/*
				 * id se utilizar para evitar compare con el mismo registro y agregue _2 al final.
				 */
				if($id)
					$this->db->query("SELECT urlFriendly FROM posts WHERE urlFriendly='$out' and idPost<>$id");
				else
					$this->db->query("SELECT urlFriendly FROM posts WHERE urlFriendly='$out'");

				++$c;

			}while($this->db->fetchRow());

			$urlFriendly = $out;
		}
		
		// $urlFriendly = $out.($c>1?"_$c":'');
		
		return $urlFriendly;
	}
	
	/*
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
	*/
	
	/*
	public function updateTags($post_id,$tags_raw=''){
		if(get_magic_quotes_gpc())
			$tags_raw = stripslashes($tags_raw);

		
		// Extrayendo Etiquetas que estan entre "tag" o 'tag'.
		$tags_raw = preg_replace('/\s+?/',' ',$tags_raw);		
		$tags_regexp = '/[\"\']((?:[^\S]|[\s\w])+?)[\"\']/';
		preg_match_all($tags_regexp,$tags_raw,$tags);
		$tags_raw = preg_replace($tags_regexp,'',$tags_raw);
		unset($tags[0]);
		$tags = $tags[1];

		
		// Extraemos el resto de tags separados por espacios.
		$tags = array_merge($tags,array_unique(explode(' ',$tags_raw)));
		unset($tags_raw);

		
		// Actualizamos tags para el $post_id pasado como parametro.
		// $tags contiene todos los tags que se relacionaran con la entrada actual.
		foreach($tags as $tag){
			if($tag != ''){
				$tag = $this->sql_escape($tag);

				$tag_id = $this->tagExists($tag);
				if($tag_id){
					#1.- Si no existe la relacion agregarla
					$this->db->query("select * from rel_tags where idPost=$post_id and idTag=$tag_id");
					$row = $this->db->fetchRow();
					if(!$row)
						$this->db->query("insert into rel_tags(idPost,idTag) values($post_id,$tag_id)");
				}else{
					$tag_id = $this->addTag($tag);
					$this->db->query("insert into rel_tags(idPost,idTag) values($post_id,$tag_id)");
				}
			}
		}
	}
	*/
	
	/*
	public function tagExists($tag){
		$tag = $this->sql_escape($tag);
		$this->db->query("select * from tags as t where t.urlfriendly = '".$this->buildUrl($tag,null,false)."'"); 
		if($row = $this->db->fetchRow())
			return $row['idTag'];
		return false;
	}
	*/
	
	/*
	public function addTag($tag){
		$tag = $this->sql_escape($tag);
		$this->db->query("insert into tags(tag,urlfriendly) values('".$tag."','".$this->buildUrl($tag,null,false)."')");
		return $this->db->lastId();
	}
	*/
	
	public function getByTag($tag,$limitQuery){
		$tag = $this->sql_escape($tag);

			$sql = "SELECT \n";
			$sql .= "\tp.idPost,p.idUser,p.urlfriendly,p.title,IF(POSITION('<!--more-->' IN p.content)>0,MID(p.content,1,POSITION('<!--more-->' IN p.content)-1),p.content) as content, created \n";
			$sql .= "FROM posts as p\n";
			$sql .= "\tinner join rel_tags as tr on tr.idPost = p.idPost \n";
			$sql .= "\tinner join tags as t on t.idTag = tr.idTag \n";
			$sql .= "WHERE \n";
			$sql .= "\tp.idStatus=1 and t.urlfriendly='$tag' \n";
			$sql .= "ORDER BY \n";
			$sql .= "\tp.idPost DESC\n";
			$sql .= "LIMIT \n";
			$sql .= "\t$limitQuery";
			
		return $this->findAllBySql($sql);
	}
	
}
