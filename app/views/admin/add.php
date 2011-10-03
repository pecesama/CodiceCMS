<div class="row">
    <div class="span12">
      <?php echo $this->html->form("admin/add/"); ?>
        <fieldset>
          <legend>Add entry</legend>
          
          <div class="clearfix">
          	<label for="title">Title</label>
          	<div class="input">
				<?php echo $this->html->textField("title", " class='xlarge'"); ?>
        <?php echo $this->html->linkTo("?","#"," rel='popover' title='Title' data-content='Description about Title.'"); ?>
			</div>
          </div>

          <div class="clearfix">
			<label for="urlfriendly">URl friendly</label>
			<div class="input">
				<?php echo $this->html->textField("urlfriendly", " class='xlarge' ");?>
        <?php echo $this->html->linkTo("?","#"," rel='popover' title='Title' data-content='Description about URL friendly.'"); ?>
			</div>
          </div>

          <div class="clearfix">
          	<label for="content">Content for the entry</label>
          	<div class="input">
				<?php echo $this->html->textArea("content", null, " rows=\"3\" class='xxlarge'"); ?>

			</div>
          </div>

          <div class="clearfix">
          	<label for="tags">Labels or Tags</label>
      			<div class="input">
      				<p>Separate each tag with a space: urban moblog phone. Or to join 2 words in one tag, use double quotes: "daily commute".</p>
              
              <?php echo $this->html->textField("tags", " class=\"xlarge\" "); ?>
              <?php echo $this->html->linkTo("?","#"," rel='popover' title='Title' data-content='Description about Labels or Tags.'"); ?>
      			</div>
          </div>

    	  <div class="actions">
            <input type="submit" class="btn primary" name="borrador" value="Save as Draft">
            <input type="submit" class="btn danger" name="publicar" value="Publish Entry">
            <button type="reset" class="btn">Cancel</button>
          </div>

        </fieldset>
      </form>
    </div>
  </div><!-- /row -->

<?php echo $this->renderElement("admin_footer"); ?>

<script>
$('textarea')
.css("border","1px solid red")
.popover(options);
</script>