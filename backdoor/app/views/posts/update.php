<div class="row">
    <div class="span12">
      <?php echo $this->html->form("posts/update/".$id."/"); ?>

        <fieldset>
          <legend>Updating entry <strong><?php echo $post["title"]; ?></strong></legend>
          
          <div class="clearfix">
          	<label for="title">Title</label>
          	<div class="input">
				<?php echo $this->html->textField("title", " class='xlarge' value=\"".$post["title"]."\" rel='popover' title='aaa' data-content='This is a test!'"); ?>
        <?php echo $this->html->linkTo("?","#"," rel='popover' title='Title' data-content='Description about title.'"); ?>
			</div>
          </div>

          <div class="clearfix">
			<label for="urlfriendly">URL friendly</label>
			<div class="input">
				<?php echo $this->html->textField("urlfriendly", " value=\"".$post["urlfriendly"]."\" class='xlarge' ");?>
        <?php echo $this->html->linkTo("?","#"," rel='popover' title='Title' data-content='Description about URL friendly.'"); ?>
			</div>
          </div>

          <div class="clearfix">
          	<label for="status">Publishing status</label>
          	<div class="input">
				<?php echo $this->html->selectFromModel("status", $statuses, $post["idStatus"], "name", "idStatus"); ?>
        <?php echo $this->html->linkTo("?","#"," rel='popover' title='Title' data-content='Description about Publishing status.'"); ?>
			</div>
          </div>

          <div class="clearfix">
          	<label for="content">Content for the entry</label>
          	<div class="input">
				<?php echo $this->html->textArea("content", $post["content"], " rows=\"3\" class='xxlarge'"); ?>
        
			</div>
          </div>

          <div class="clearfix">
          	<label for="tags">Labels or Tags</label>
            <div class="input">
              <p>Separate each tag with a space: urban moblog phone. Or to join 2 words in one tag, use double quotes: "daily commute".</p>
              
      				<?php echo $this->html->textField("tags", " value=\"".htmlspecialchars($post["tags"])."\" class=\"xlarge\" "); ?>
              <?php echo $this->html->linkTo("?","#"," rel='popover' title='Title' data-content='Description about Tags or Labels.'"); ?>
      			</div>
          </div>

    	  <div class="actions">
            <input type="submit" class="btn success" value="Update entry">
            <?php echo $this->html->linkTo("Cancel","entries","class='btn'"); ?>
          </div>
        </fieldset>
      </form>
    </div>
  </div><!-- /row -->
