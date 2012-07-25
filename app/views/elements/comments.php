<?php if($post['comments']){?>
	<h4 id="comments"><?php echo $post['comments_count']; ?> comentarios en <?php echo $post['title']; ?></h4>
	<div class="commentlist">
		<?php foreach($post['comments'] as $comment){ ?>
			<div class="comentario" id="comment-<?php echo $comment['idComment']; ?>">
				<img alt="" src="http://www.gravatar.com/avatar/<?php $comment['md5_email'];?>?s=50" class="avatar avatar-50 photo" width="50" height="50">
				<p class="comment_author">
					<?php if($comment['url'] == ''){?>
						<?php echo $comment['author']; ?>
					<?php }else{ ?>
						<a href="<?php echo $comment['url']; ?>" rel="external nofollow" class="url"><?php echo $comment['author']; ?></a>
					<?php }?>
				</p>
				<div class="comment_meta commentmetadata">
					<p>
						<?php echo $this->html->linkTo($comment['created'],"{$post['urlfriendly']}/#comment-{$comment['idComment']}"); ?>
					</p>
				</div>
				<div class="comment_txt">
					<p><?php echo $comment['content']; ?></p>
				</div>
			</div>
		<?php } ?>
	</div>
<?php }?>
