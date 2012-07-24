<div class="row">
    <div class="span12">
      <?php echo $this->html->form("comments/update/{$comment['idComment']}"); ?>
        <fieldset>
          <legend>Edit comment</legend>
          
			<div class="clearfix">
				<label for="title">Post</label>
				<div class="input">
					<?php echo $post['title']; ?>
					<?php //echo $this->html->linkTo("?","#"," rel='popover' title='Title' data-content='Description about Title.'"); ?>
				</div>
			</div>

			<div class="clearfix">
				<label for="urlfriendly">Author</label>
				<div class="input">
					<?php echo $this->html->linkTo($comment['author'], $comment['url'], "", true); ?> (<?php echo $comment['email']; ?>) - <?php echo date("D d-m-Y H:i:s", strtotime($comment["created"]) ); ?>
				</div>
			</div>

			<div class="clearfix">
				<label for="content">Comment</label>
				<div class="input">
					<?php echo $this->html->textArea("content", $comment['content'], ' rows="3" class="xxlarge" placeholder="content"'); ?>
				</div>
			</div>
			
		<div class="clearfix">
          	<label for="status">Publishing status</label>
          	<div class="input">
	                <?php echo $this->html->selectFromModel("idStatus", $statuses, $comment["idStatus"], "name", "idStatus"); ?>
	                <?php echo $this->html->linkTo("?","#"," rel='popover' title='Title' data-content='Description about Publishing status.'"); ?>
	            </div>
	      </div>
	      
      	  <div class="actions">
            <input type="submit" class="btn success" name="btn[Success]" value="Update comment">
            <?php echo $this->html->linkTo("Cancel","comments/"," class='btn'"); ?> 
          </div>
	      
		</fieldset>
	</form>
	</div>
</div>

