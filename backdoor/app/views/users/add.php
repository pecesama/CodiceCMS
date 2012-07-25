<div class="row">
	<div class="span12">

		<?php if(isset($idUser)){ ?>
			<?php echo $this->html->form("users/update/{$user['idUser']}"); ?>
		<?php }else{ ?>
			<?php echo $this->html->form("users/add/"); ?>
		<?php }	?>
		
		<fieldset>
			<?php if(isset($idUser)){ ?>
				<legend>Edit user</legend>
			<?php }else{ ?>
				<legend>Add user</legend>
			<?php }	?>
			
			<div class="clearfix">
				<label for="status">First name</label>
				<div class="input">
					<?php echo $this->html->textField("user[firstName]", isset($user['firstName'])?$user['firstName']:''); ?>
				</div>
			</div>

			<div class="clearfix">
				<label for="status">Last name</label>
				<div class="input">
					<?php echo $this->html->textField("user[lastName]", isset($user['lastName'])?$user['lastName']:''); ?>
				</div>
			</div>

			<div class="clearfix">
				<label for="status">User</label>
				<div class="input">
					<?php echo $this->html->textField("user[user]", isset($user['user'])?$user['user']:''); ?>
					<?php echo $this->html->linkTo("?","#"," rel='popover' title='Title' data-content='The user represents the identifier that user will use to login in.'"); ?>
				</div>
			</div>

			<div class="clearfix">
				<label for="status">Password</label>
				<div class="input">
					<?php echo $this->html->passwordField("user[password]", null); ?>
					<?php echo $this->html->linkTo("?","#"," rel='popover' title='Title' data-content='The password that user will user to login in.'"); ?>
				</div>
			</div>

			<div class="clearfix">
				<label for="status">Email</label>
				<div class="input">
					<?php echo $this->html->textField("user[email]", isset($user['email'])?$user['email']:''); ?>
					<?php echo $this->html->linkTo("?","#"," rel='popover' title='Title' data-content='The email get in touch with user.'"); ?>
				</div>
			</div>

			<div class="clearfix">
				<label for="status">Website</label>
				<div class="input">
					<?php echo $this->html->textField("user[website]", isset($user['website'])?$user['website']:''); ?>
					<?php echo $this->html->linkTo("?","#"," rel='popover' title='Title' data-content='Website of the user, if he/she has one.'"); ?>
				</div>
			</div>

			<div class="clearfix">
				<label for="status">About</label>
				<div class="input">
					<?php echo $this->html->textArea("user[about]", isset($user['about'])?$user['about']:''); ?>
					<?php echo $this->html->linkTo("?","#"," rel='popover' title='Title' data-content='A small biography or description of the user.'"); ?>
				</div>
			</div>

			<div class="actions">
				<input type="submit" class="btn success" name="btn[Success]" value="Save changes">
				<?php echo $this->html->linkTo("Cancel","users/"," class='btn'"); ?> 
			</div>
		</fieldset>
	</form>
	</div>
</div>

