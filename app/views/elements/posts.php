<?php if(count($posts) > 0){?>
	<?php foreach($posts as $post){?>
		<div class="post">
			<h3><?php echo $this->html->linkTo($post["title"],$post["urlfriendly"],'rel="bookmark" title="Enlace a '.$post["title"].'"'); ?></h3>
			<?php if(isset($busqueda) === false){?>
				<div class="facebook">
					<fb:like href="http://mis-algoritmos.com/<?php echo $post['urlfriendly']; ?>" layout="button_count"></fb:like>
				</div> 
				<div class="post_txt">
					<?php echo $post["content"]; ?>
				</div>		
				<div class="post_meta_com">
					<p><?php echo $this->html->linkTo($post["comments_count"],"{$post["urlfriendly"]}#comments",'rel="bookmark" title="Comentarios de '.$post["title"].'"'); ?> &#187;</p>
					<?php if($post["tags"]){ ?>
						<p class="tags">
							Tags:
							<?php foreach($post["tags"] as $tag){ ?>
								<?php echo $this->html->linkTo($tag["tag"],"tag/{$tag["urlfriendly"]}"); ?>
							<?php }//foreach ?>
							<br />
						</p>
					<?php } ?>
				</div><!-- post_meta_com -->
				<div class="post_meta">
					<p>Escrito por <?php echo $post["autor"]["name"]; ?> el <?php echo $post["created"]?></p>
				</div><!-- post_meta -->
			<?php } ?>
	<?php } ?>
	<?php echo $pagination; ?>
<?php }else{?>
	<h2 class="center">No se encontró lo que buscabas :(</h2>
	<p class="center">Lo sentimos, pero parece que lo que buscas no está aqui.</p>
<?php } ?>
