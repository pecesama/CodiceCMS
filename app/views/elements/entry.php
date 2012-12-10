<div class="entry debug">
	<h3><?php echo $post['title']; ?></h3>
	<?php echo $post['content']; ?>
</div>

<div class="metadata debug">
		Escrito por <?php echo $post['author']['firstName'],' ',$post['author']['lastName']; ?> el <?php echo date('D d-m-Y h:i:s a', strtotime($post['created'])); ?>

		<?php if ($post['tags']) {
			foreach ($post['tags'] as $tag) {
				echo $this->html->linkTo($tag['tag'],"tag/{$tag['urlfriendly']}");
			}
		} ?>


		<?php echo $this->html->linkTo($post['comments_count'] . ' Comments',"{$post['urlfriendly']}#comments",'rel="bookmark" title="Comments in '.$post['title'].'"'); ?> &#187;
</div>

<div class="comunity">
	<?php echo $this->renderElement('comments'); ?>
	
	<h4 class="respond">Leave a message</h4>
	<?php echo $this->renderElement('comments_add'); ?>
</div>