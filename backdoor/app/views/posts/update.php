<div class="row">
    <div class="span16">
      <?php echo $this->html->formFiles("posts/update/{$post['idPost']}/"); ?>

        <fieldset>
          <legend>Updating entry <strong><?php echo $post["title"]; ?></strong></legend>
          
          <div class="clearfix">
          	<label for="status">Publishing status</label>
          	<div class="input">
                    <?php echo $this->html->selectFromModel("idStatus", $statuses, $post["idStatus"], "name", "idStatus"); ?>
                    <?php echo $this->html->linkTo("?","#"," rel='popover' title='Title' data-content='Description about Publishing status.'"); ?>
                </div>
          </div>
          
          <?php $this->renderElement('postForm'); ?>

    	  <div class="actions">
            <input type="submit" name="update" class="btn success" value="Update entry">
            <?php echo $this->html->linkTo("Cancel","posts","class='btn'"); ?>
          </div>
        </fieldset>
        
      </form>
    </div>
</div><!-- /row -->
