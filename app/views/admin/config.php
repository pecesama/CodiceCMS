
<div class="row">
    <div class="span12">
		<?php echo $this->html->form("admin/config"); ?>
			<fieldset>
				
				<legend>Blog configuration</legend>
				

				<?php foreach($conf as $name => $value){ ?>
					<div class="clearfix">
						<label for="<?php echo $name; ?>"><?php echo $name; ?></label>
						<div class="input">
							<?php echo $this->html->textField($name, " value=\"$value\" class=\"xlarge\" ");?>
						</div>
					</div>
				<?php } ?>
			</fieldset>

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

			<div class="actions">
				<input class="btn danger" type="submit" value="Save changes" /> 
				<?php echo $this->html->linkTo("Cancel","admin","class='btn'"); ?>
			</div>
		</form>
	</div>
</div>
	<?php echo $this->renderElement("admin_footer"); ?>
