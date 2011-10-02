
<?php echo $this->html->form("admin/edit/".$id."/"); ?>

<div class="row">
    <div class="span12">
      <form>
        <fieldset>
          <legend>Updating entry <strong><?php echo $post["title"]; ?></strong></legend>
          
          <div class="clearfix">
          	<label for="title">Title</label>
          	<div class="input">
				<?php echo $this->html->textField("title", " class='xlarge' value=\"".$post["title"]."\" "); ?>
			</div>
          </div>

          <div class="clearfix">
			<label for="urlfriendly">URl friendly</label>
			<div class="input">
				<?php echo $this->html->textField("urlfriendly", " value=\"".$post["urlfriendly"]."\" class='xlarge' ");?>
			</div>
          </div>

          <div class="clearfix">
          	<label for="status">Publishing status</label>
          	<div class="input">
				<?php echo $this->html->select("status", $statuses, $post["status"]); ?>
			</div>
          </div>

          <div class="clearfix">
          	<label for="content">Content for the entry</label>
          	<div class="input">
				<?php echo $this->html->textArea("content", $post["content"], " rows=\"3\" class='xxlarge'"); ?>
			</div>
          </div>

          <div class="clearfix">
          	<label for="tags">Etiquetas</label>
            <div class="input">
              <p>Separate each tag with a space: urban moblog phone. Or to join 2 words in one tag, use double quotes: "daily commute".</p>
              
      				<?php echo $this->html->textField("tags", " value=\"".htmlspecialchars($post["tags"])."\" class=\"xlarge\" "); ?><br />
      			</div>
          </div>

    	  <div class="actions">
            <input type="submit" class="btn primary" value="Update entry">
            <button type="reset" class="btn">Cancel</button>
          </div>
        </fieldset>
      </form>
    </div>
  </div><!-- /row -->

<?php echo $this->renderElement("admin_footer"); ?>
