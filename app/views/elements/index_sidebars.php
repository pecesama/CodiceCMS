<div id="sidebars">
	<div class="sidebar clearfix">
		<h4 class="widgettitle">Amigos y Recomendados</h4>
		<?php foreach($links as $link){ ?>
			<?php echo $this->html->linkTo($link['name'],$link['link'],'',true); ?>
		<?php } ?>
	</div>
</div><!-- sidebars -->