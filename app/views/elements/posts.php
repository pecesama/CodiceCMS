<?php if(count($posts) > 0){?>
	<?php foreach($posts as $post){?>
		<div class="row">
			<h3><?php echo $this->html->linkTo($post["title"],$post["urlfriendly"],'rel="bookmark" title="Enlace a '.$post["title"].'"'); ?></h3>
			
			<div class="row"><?php echo $post["content"]; ?></div>
			
			<div class="row">
				<div class="span">Escrito por <?php echo $post["autor"]["name"]; ?> el <?php echo $post["created"]?></div>
				<div class="span">
					<?php if($post["tags"]){ ?>
						<?php foreach($post["tags"] as $tag){ ?>
							<?php echo $this->html->linkTo($tag["tag"],"tag/{$tag["urlfriendly"]}"); ?>
						<?php }?>
					<?php } ?>
				</div>
				<div class="span"><?php echo $this->html->linkTo($post["comments_count"] . " Comments","{$post["urlfriendly"]}#comments",'rel="bookmark" title="Comentarios de '.$post["title"].'"'); ?> &#187;</div>
				<div class="span facebook"><fb:like href="http://mis-algoritmos.com/<?php echo $post['urlfriendly']; ?>" layout="button_count"></fb:like></div>
			</div>
		</div>
	<?php } ?>
	<?php echo $pagination; ?>
<?php }else{?>
	<h3>Your search did not match any documents.</h3>
<?php } ?>
