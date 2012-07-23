<h1>Codice - CMS</h1>
<div class="row">
	<div class="span12">
		<?php echo $this->html->form("login"); ?>
			<fieldset>
				<legend>Authentication</legend>
				
				<?php if ($this->session->issetFlash()) { ?>
					<div class="alert-message error">
					  <p><strong>Holy guacamole!</strong> <?php echo $this->session->getFlash(); ?></p>
					</div>
				<?php } ?>

				<div class="clearfix">
					<label for="login">User</label>
					<div class="input">
						<?php echo $this->html->textField("login", "", "class=\"short\" "); ?>
					</div>
				</div>
				
				<div class="clearfix">
					<label for="password">Password</label> 
					<div class="input">
						<?php echo $this->html->passwordField("password", "", " class=\"short\" "); ?>
					</div>
				</div>
							
				<div class="actions">
					<input type="submit" class="btn" value="Ingresar" />
				</div>

			</legend>	
		</form>
	</div>
</div>
<?php echo $this->renderElement("admin_footer"); ?>