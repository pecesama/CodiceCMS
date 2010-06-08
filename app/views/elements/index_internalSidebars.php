<?php foreach($links as $link){ ?>
	<?php echo $this->html->linkTo($link['name'],$link['link'],'',true); ?>
<?php } ?>


