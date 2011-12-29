<div id="prompt_pass">
	<?php echo $this->html->formPost('files/get/'.$file_id.'/'.$name) ?>
	<h2><?php echo $this->l10n->__("Password para el archivo"); ?></h2>
	<h3><?php echo urldecode($name); ?></h3>
	<p class='error'><?php echo $this->session->getFlash() ?></p>
		<input type="password" name="file_<?php echo $file_id ?>psw" value="" id="file_password"><br/>
		<input type="submit" name="get_file" value="Download" id="get_file">
	</form>
</div>