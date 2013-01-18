<?php if(count($posts) > 0){?>
	<?php foreach($posts as $post){?>
		<div>
			<h3><?php echo $this->html->linkTo($post["title"],$post["urlfriendly"],'rel="bookmark" title="Enlace a '.$post["title"].'"'); ?></h3>

			<div class="row">
				<div class="span">Escrito por <?php echo $post["author"]["firstName"]; ?> <?php echo $post["author"]["lastName"]; ?> el <?php echo date("D d-m-Y h:i:s a", strtotime($post["created"])); ?></div>
				<div class="span">
					<?php if($post["tags"]){ ?>
						<?php foreach($post["tags"] as $tag){ ?>
							<?php echo $this->html->linkTo($tag["tag"],"tag/{$tag["urlfriendly"]}"); ?>
						<?php }?>
					<?php } ?>
				</div>
				<div class="span"><?php echo $this->html->linkTo($post["comments_count"] . " Comments","{$post["urlfriendly"]}#comments",'rel="bookmark" title="Comentarios de '.$post["title"].'"'); ?> &#187;</div>
			</div>

			<?php echo $post["content"]; ?>
		</div>
		<hr />
	<?php } ?>
	<div>
		<?php echo $pagination; ?>
	</div>
<?php }else{?>
	<h3>Your search did not match any documents.</h3>
<?php } ?>
