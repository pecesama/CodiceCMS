<div id="sidebar">
	<div class="navigation">
		<h4>Navigation</h4>
		<?php foreach($links as $link){ ?>
			<?php echo $this->html->linkTo($link['name'],$link['link'],'',true); ?>
		<?php } ?>
	</div>
</div><!-- sidebars -->