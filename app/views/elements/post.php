<div class="post">
	<h3><?php echo $post['title']; ?></h3>
	
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

	<div class="facebook"> 
		<fb:like href="http://mis-algoritmos.com/<?php echo $post['urlfriendly']; ?>" layout="button_count"></fb:like>
	</div>
	<div class="post_txt">
		<?php echo $post['content']; ?>
	</div>
	<div class="facebook"> 
		<fb:like href="http://mis-algoritmos.com/<?php echo $post['urlfriendly']; ?>" layout="button_count"></fb:like>
	</div>
	<div class="comentarios">
		<?php echo $this->renderElement("comentarios"); ?>
		
		<h4 class="respond">Deja un comentario</h4>
		<?php echo $this->renderElement("form_addComment"); ?>
	</div>
</div>
