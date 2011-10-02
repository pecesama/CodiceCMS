<div class="row">
	<div class="span12">
		<?php echo $this->html->form("admin/login/"); ?>
			<fieldset>
				<legend>Authentication</legend>
				
				<?php if ($this->cookie->check('flash')) { ?>
					<div class="alert-message error">
					  <p><strong>Holy guacamole!</strong> <?php echo $this->cookie->flash; ?></p>
					</div>
				<?php } ?>

				<div class="clearfix">
					<label for="login">Usuario</label>
					<div class="input">
						<?php echo $this->html->textField("login", " class=\"short\" "); ?>
					</input>
				</div>
				
				<div class="clearfix">
					<label for="password">Contrase&ntilde;a</label> 
					<div class="input">
						<?php echo $this->html->passwordField("password", " class=\"short\" "); ?>
					</input>
				</div>				
							
				<div class="actions">
					<input type="submit" class="btn" value="Ingresar" />
				</div>

			</legend>	
		</form>
	</div>
</div>
<?php echo $this->renderElement("admin_footer"); ?>