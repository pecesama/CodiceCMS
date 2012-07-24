<h1><?php echo $this->html->linkTo("Entries", "posts/"); ?></h1>

<div class="row">

	<div class="span8">
		<h2><?php echo $post['title']; ?></h2>
		<span>Created: <?php echo date("D d-m-Y H:i:s", strtotime($post['created'])); ?>, last update: <?php echo date("D d-m-Y H:i:s", strtotime($post['modified'])); ?></span>
		<span>by <?php echo $user['lastName']; ?>, <?php echo $user['firstName']; ?></span>
		<br />
		<span>status: <?php echo $status['name']; ?></span>
		<div class="post-content">
			<?php echo $post['content']; ?>
		</div>

		<div>
			<?php echo $this->html->linkTo("Edit","posts/update/{$post["idPost"]}"," rel='twipsy' class='btn primary' title='Modify the content of this entry'"); ?> 
			<?php echo $this->html->linkToConfirm("Remove","posts/delete/{$post["idPost"]}"," rel='twipsy' class='btn danger' title='Removes this entry.'"); ?>
		</div>

	</div>

	<div class="span8">
		<h3>Comments</h3>
	
		<?php foreach($comments as $comment): ?>
		<div class="comment">
			<?php echo $this->html->linkTo($comment['author'], $comment['url'], "", true); ?> (<?php echo $comment['email']; ?>) - <?php echo date("D d-m-Y H:i:s", strtotime($comment["created"]) ); ?><br />
			status: <i><?php echo $comment['status']; ?></i>
			<div class="well">
				<?php echo $comment['content']; ?>
			</div>
			<div>
				<?php echo $this->html->linkTo("Edit","comments/update/{$comment["idComment"]}"," class='btn primary' rel='twipsy' title='Modify the content of this comment before publishing it.'"); ?>
				<?php echo $this->html->linkToConfirm("Remove","comments/delete/{$comment["idComment"]}"," class='btn danger' rel='twipsy' title='Remove this comment.'"); ?>
				<?php if($comment['idStatus'] != 1): ?> <?php echo $this->html->linkTo("Approve","comments/approve/{$comment["idComment"]}"," class='btn success' rel='twipsy' title='Approve this comment.'"); ?> <?php endif; ?>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
	
</div>
<style type="text/css">
.comment{
	margin-bottom: 20px;
}
.post-content{
	margin: 10px 0;
}
</style>
