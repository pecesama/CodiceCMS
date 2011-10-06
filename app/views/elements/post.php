<?php
$post["autor"]["name"] = "Temporal";
?>
<div class="row">
	<h3><?php echo $post['title']; ?></h3>
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

	<script type="text/javascript"><!--
	google_ad_client = "pub-1164943173026261";
	/* 336x280, creado 9/08/09 */
	google_ad_slot = "7867597355";
	google_ad_width = 336;
	google_ad_height = 280;
	//-->
	</script>
	<script type="text/javascript"
	src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
	</script>
	<script type="text/javascript"><!--
	google_ad_client = "pub-1164943173026261";
	/* 336x280, creado 9/08/09 */
	google_ad_slot = "7867597355";
	google_ad_width = 336;
	google_ad_height = 280;
	//-->
	</script>
	<script type="text/javascript"
	src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
	</script>

	<div class="row"><?php echo $post['content']; ?></div>

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

	<div class="row">
		<?php echo $this->renderElement("comentarios"); ?>
		
		<h4 class="respond">Deja un comentario</h4>
		<?php echo $this->renderElement("form_addComment"); ?>
	</div>
</div>
