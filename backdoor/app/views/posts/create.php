<div class="row">
    <div class="span16">
      <?php echo $this->html->formFiles("posts/create/"); ?>
        <fieldset>
          <legend>Add entry</legend>
          
          <?php $this->renderElement('postForm'); ?>

    	  <div class="actions">
            <input type="submit" class="btn primary" name="btn[Draft]" value="Save as Draft">
            <input type="submit" class="btn danger" name="btn[Publish]" value="Publish Entry">
            <?php echo $this->html->linkTo("Cancel","posts"," class='btn'"); ?> 
          </div>

        </fieldset>
      </form>
    </div>
  </div><!-- /row -->
