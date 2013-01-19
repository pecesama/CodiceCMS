<?php if(count($posts) > 0){?>
	<?php foreach($posts as $post){?>
		<div class="entry span3">

			<?php
				switch(rand(1,15)) {
					case 1: echo '<img src="http://media-cache-ec3.pinterest.com/upload/126663808241602233_nC0pK7gD_b.jpg" />'; break;
					case 2: echo '<img src="http://media-cache-ec6.pinterest.com/upload/60869032435544636_hzmuj2VY_b.jpg" />'; break;
					case 3: echo '<img src="http://media-cache-ec5.pinterest.com/upload/216735800789023971_1nX60nTa_b.jpg" />'; break;
					case 4: echo '<img src="http://media-cache-ec3.pinterest.com/upload/23292123042870526_PqWesGdj_b.jpg" />'; break;
					case 5: echo '<img src="http://media-cache0.pinterest.com/upload/88875792615901169_gIk5CEhW_b.jpg" />'; break;
					case 6: echo '<img src="http://media-cache-ec5.pinterest.com/upload/219057969345137303_62i302HP_b.jpg" />'; break;
					case 7: echo '<img src="http://media-cache-ec6.pinterest.com/upload/142918988145448592_e9uWOFrd_b.jpg" />'; break;
					case 8: echo '<img src="http://media-cache-lt0.pinterest.com/upload/46584177367553793_QMPPZ4rd_b.jpg" />'; break;
					case 9: echo '<img src="http://media-cache-ec2.pinterest.com/upload/46584177367553754_BGgsk7xs_b.jpg" />'; break;
					case 10: echo '<img src="http://media-cache-ec2.pinterest.com/upload/186125397071677023_AQfSByN4_b.jpg" />'; break;
					case 11: echo '<img src="http://media-cache-ec5.pinterest.com/upload/37788084345700782_MBUQ4EoA_b.jpg" />'; break;
					case 12: echo '<img src="http://media-cache-lt0.pinterest.com/upload/46584177367550855_5A3TGLK2_b.jpg" />'; break;
					case 13: echo '<img src="http://media-cache-lt0.pinterest.com/upload/46936021088518733_O4swtkge_b.jpg" />'; break;
					case 14: echo '<img src="http://media-cache-ec6.pinterest.com/upload/6051780721284828_vmXq2I0W_b.jpg" />'; break;
					case 15: echo '<img src="http://media-cache-ec4.pinterest.com/upload/121034308705062031_ryRNDfAN_b.jpg" />'; break;
				}
			?>

			<h3><?php echo $this->html->linkTo($post['title'],$post['urlfriendly'],'rel="bookmark" title="Enlace a '.$post['title'].'"'); ?></h3>

			<?php echo $post['content']; ?>

			<div class="row comments">
				<div class="comments-list" id="comments-list-post1">
					<div class="span3 comment" id="comment-post1-1">
						<img src="http://media-cache-ec4.pinterest.com/avatars/michellemoore_1337060759.jpg" />
						<b>Suzette</b>
						<p>Nice post</p>
					</div>
					<div class="span3 comment" id="comment-post1-2">
						<img src="http://media-cache-ec4.pinterest.com/avatars/michellemoore_1337060759.jpg" />
						<b>Suzette</b>
						<p>Nice post</p>
					</div>
					<div class="span3 comment" id="comment-post1-3">
						<img src="http://media-cache-ec4.pinterest.com/avatars/michellemoore_1337060759.jpg" />
						<b>Suzette</b>
						<p>Nice post</p>
					</div>
				</div>
				<div class="span3 comments-count" id="comment-post1-count">
					<?php echo $this->html->linkTo($post['comments_count'] . " Comments","{$post['urlfriendly']}#comments",'rel="bookmark" title="Comments on '.$post['title'].'"'); ?> &#187;
				</div>
			</div>

		</div>
	<?php } ?>
	<div>
		<?php echo $pagination; ?>
	</div>
<?php }else{?>
	<h3>Your search did not match any documents.</h3>
<?php } ?>
