
<div class="row">
    <div class="span12">
		<?php echo $this->html->form("config/"); ?>
			<fieldset>
				
				<legend>Blog configuration</legend>
					
				<div class="clearfix">
					<label for="blogName">Blog name:</label>
					<div class="input">
						<?php echo $this->html->textField('blogName', $config['blogName'], 'class="xlarge" ');?>
					</div>
				</div>

				<div class="clearfix">
					<label for="blogName">Blog description:</label>
					<div class="input">
						<?php echo $this->html->textarea('description', $config['description'], 'class="xlarge" ');?>
					</div>
				</div>

				<div class="clearfix">
					<label for="blogName">Posts per page:</label>
					<div class="input">
						<?php echo $this->html->select('postsPerPage', range(1, 50), $config['postsPerPage'], 'class="xlarge" ');?>
					</div>
				</div>

				<div class="clearfix">
					<label for="blogName">Posts per page in admin:</label>
					<div class="input">
						<?php echo $this->html->select('postsPerPageAdmin', range(1, 50), $config['postsPerPageAdmin'], 'class="xlarge" ');?>
					</div>
				</div>

				<div class="clearfix">
					<label for="blogName">Upload folder:</label>
					<div class="input">
						<?php echo $this->html->textField('uploadFolder', $config['uploadFolder'], 'class="xlarge" readOnly="readOnly"');?>
					</div>
				</div>
			</fieldset>
<?php /*
			<fieldset>
				<legend>User configuration</legend>

				<?php foreach($userConf as $name => $value){ ?>
					<div class="clearfix">
						<label for="<?php echo $name; ?>"><?php echo $name; ?></label>
						<div class="input">
							<?php echo $this->html->textField($name, " value=\"$value\" class=\"xlarge\" "); ?>
						</div>
					</div>
				<?php } ?>
			</fieldset>
*/ ?>

			<div class="actions">
				<input class="btn danger" type="submit" value="Save changes" /> 
				<?php echo $this->html->linkTo("Cancel","","class='btn'"); ?>
			</div>
		</form>
	</div>
</div>
