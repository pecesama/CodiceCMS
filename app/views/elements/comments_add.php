<?php echo $this->html->form("index/addComment/{$urlfriendly}","post",'id="commentform"'); ?>
	<p>¿Cuanto es 2 + 3? = <input type="text" id="resultado" name="resultado" value=""></p>
	<p>
		<label for="author">Nombre (requerido)</label>
		<?php echo $this->html->textField("author", $cookie["author"], ' size="22" tabindex="1"'); ?>
		<?php echo $this->html->validateError("author"); ?>
	</p>
	<p>
		<label for="email">Email (requerido)</label>
		<?php echo $this->html->textField("email", $cookie["email"], ' size="22" tabindex="2"'); ?>
		<?php echo $this->html->validateError("email"); ?>
	</p>
	<p>
		<label for="url">Website/Blog</label>
		<?php echo $this->html->textField("url", $cookie["url"],' size="22" tabindex="3"'); ?>
		<?php echo $this->html->validateError("url"); ?>
	</p>
	<p>
		<label>Comentario</label>
		<?php echo $this->html->textArea("content",'','cols="100" rows="10" tabindex="4"'); ?>
		<?php echo $this->html->validateError("content"); ?>
	</p>
	
	<p>
	<?php echo $this->html->checkBox("suscribe",'value="1" checked="true"'); ?>
	Suscribirse a los comentarios.
	</p>

	<p>
		<input id="submit" tabindex="5" value="Submit Comment" type="submit">
	</p>
</form>
