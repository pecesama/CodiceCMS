<div>
	<h3><?php echo $post['title']; ?></h3>
				<div class="row">
				<div class="span">Escrito por <?php echo $post["author"]["firstName"]." ".$post["author"]["lastName"]; ?> el <?php echo date("D d-m-Y h:i:s a", strtotime($post["created"])); ?></div>
				<div class="span">
					<?php if($post["tags"]){ ?>
						<?php foreach($post["tags"] as $tag){ ?>
							<?php echo $this->html->linkTo($tag["tag"],"tag/{$tag["urlfriendly"]}"); ?>
						<?php }?>
					<?php } ?>
				</div>
				<div class="span"><?php echo $this->html->linkTo($post["comments_count"] . " Comments","{$post["urlfriendly"]}#comments",'rel="bookmark" title="Comments in '.$post["title"].'"'); ?> &#187;</div>
<?php /*				<div class="span facebook"><fb:like href="http://mis-algoritmos.com/<?php echo $post['urlfriendly']; ?>" layout="button_count"></fb:like></div> */ ?>
			</div>
			
	<?php echo $post['content']; ?>

<?php /*
			<div class="row">
				<div class="span">Escrito por <?php echo $post["autor"]["name"]; ?> el <?php echo $post["created"]?></div>
				<div class="span">
					<?php if($post["tags"]){ ?>
						<?php foreach($post["tags"] as $tag){ ?>
							<?php echo $this->html->linkTo($tag["tag"],"tag/{$tag["urlfriendly"]}"); ?>
						<?php }?>
					<?php } ?>
				</div>
				<div class="span"><?php echo $this->html->linkTo($post["comments_count"] . " Comments","{$post["urlfriendly"]}#comments",'rel="bookmark" title="Comments in '.$post["title"].'"'); ?> &#187;</div>
				<div class="span facebook"><fb:like href="http://mis-algoritmos.com/<?php echo $post['urlfriendly']; ?>" layout="button_count"></fb:like></div> 
			</div>
			*/ ?>

	<div class="row">
		<?php echo $this->renderElement("comments"); ?>
		
		<h4 class="respond">Deja un comentario</h4>
		<?php echo $this->renderElement("comments_add"); ?>
	</div>
</div>
