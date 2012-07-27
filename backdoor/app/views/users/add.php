<div class="row">
	<div class="span12">

		<?php if(isset($user['idUser'])){ ?>
			<?php echo $this->html->form("users/update/{$user['idUser']}"); ?>
			<?php echo $this->html->hiddenField("user[idUser]", $user['idUser']); ?>
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
					<?php echo $this->html->validateError("firstName"); ?>
				</div>
			</div>

			<div class="clearfix">
				<label for="status">Last name</label>
				<div class="input">
					<?php echo $this->html->textField("user[lastName]", isset($user['lastName'])?$user['lastName']:''); ?>
					<?php echo $this->html->validateError("lastName"); ?>
				</div>
			</div>

			<div class="clearfix">
				<label for="status">* User</label>
				<div class="input">
					<?php echo $this->html->textField("user[user]", isset($user['user'])?$user['user']:''); ?>
					<?php echo $this->html->linkTo("?","#"," rel='popover' title='User' data-content='The user represents the identifier that user will use to login in.'"); ?>
					<?php echo $this->html->validateError("user"); ?>
				</div>
			</div>

			<div class="clearfix">
				<label for="status">* Password</label>
				<div class="input">
					<?php echo $this->html->passwordField("user[password]", null); ?>
					<?php echo $this->html->linkTo("?","#"," rel='popover' title='Password' data-content='The password that user will user to login in.'"); ?>
					<?php echo $this->html->validateError("password"); ?>
				</div>
			</div>

			<div class="clearfix">
				<label for="status">* Email</label>
				<div class="input">
					<?php echo $this->html->textField("user[email]", isset($user['email'])?$user['email']:''); ?>
					<?php echo $this->html->linkTo("?","#"," rel='popover' title='Email' data-content='The email get in touch with user.'"); ?>
					<?php echo $this->html->validateError("email"); ?>
				</div>
			</div>

			<div class="clearfix">
				<label for="status">Website</label>
				<div class="input">
					<?php echo $this->html->textField("user[website]", isset($user['website'])?$user['website']:''); ?>
					<?php echo $this->html->linkTo("?","#"," rel='popover' title='Website' data-content='Website of the user, if he/she has one.'"); ?>
					<?php echo $this->html->validateError("website"); ?>
				</div>
			</div>

			<div class="clearfix">
				<label for="status">About</label>
				<div class="input">
					<?php echo $this->html->textArea("user[about]", isset($user['about'])?$user['about']:''); ?>
					<?php echo $this->html->linkTo("?","#"," rel='popover' title='About' data-content='A small biography or description of the user.'"); ?>
					<?php echo $this->html->validateError("about"); ?>
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

