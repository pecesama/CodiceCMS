	<?php echo $this->renderElement("admin_header"); ?>

	<div id="page-navigation" class="clearfix">
			<ul>
				<li>
					<?php echo $this->html->linkTo("Administrar posts", "admin/", " title=\"Administrar los posts\""); ?>
				</li>
				<li class="current">
					<?php echo $this->html->linkTo("Administrar comentarios", "comments/", " title=\"Administrar los comentarios\""); ?>
				</li>
				<li>
					<?php echo $this->html->linkTo("Agregar post", "admin/add/", " title=\"Agregar un nuevo post\""); ?>
				</li>
				<li>
					<?php echo $this->html->linkTo("Configuraci&oacute;n", "admin/config/", " title=\"Configurar blog\""); ?>
				</li>
				<li>
					<?php echo $this->html->linkTo("Cerrar sesi&oacute;n", "admin/logout/", " title=\"Terminar la sesi&oacute;n\""); ?>
				</li>
				<li>
					<?php echo $this->html->linkTo("Ir al blog", "", " title=\"Regresar al blog\""); ?>
				</li>
			</ul>
				
		</div>

		<div id="page-content" class="clearfix"> 

			<h1>Codice CMS Dashboard</h1> 

			<h2>Editar comentario:</h2> 
			<div class="inner-box clearfix">

				<div id="form-block"> 

					<?php echo $this->html->form("comments/edit/".$id."/"); ?>

						<label for="status">Estado</label>
						<?php echo $this->html->select("status", $statuses, $comment["status"]); ?>

						<label for="author">Autor</label>
						<?php echo $this->html->textField("author"," value=\"{$comment["author"]}\"");?>

						<label for="email">Correo</label>
						<?php echo $this->html->textField("email"," value=\"{$comment["email"]}\"");?>

						<label for="url">URL</label>
						<?php echo $this->html->textField("url"," value=\"{$comment["url"]}\"");?>

						<label for="suscribe">Suscrito a comentarios</label>
						<?php
							$checked = $comment["suscribe"]?"checked=\"true\"":"";
							echo $this->html->checkbox("suscribe",$checked);
						?>

						<label>View post</label>
						<?php echo $this->html->linkTo("{$comment["post"]["title"]}", $comment["post"]["urlfriendly"]."/", " title=\"View posst\" target=\"_blank\""); ?>

						<label>IP</label>
						<?php echo $comment["IP"]; ?>

						<label>created</label>
						<?php echo $comment["created"]; ?>

						<label>modified</label>
						<?php echo $comment["modified"]; ?>

						<label for="content">Contenido</label>
						<?php echo $this->html->textArea("content", $comment["content"], " rows=\"3\" cols=\"3\" "); ?>

						<em>Contenido del post</em>

						<input class="submit reset" id="cancelar" name="cancelar" type="submit" value="Cancelar">
						<input class="submit" type="submit" value="Modificar" />

						</form>

				</div> 
			
			</div> 
		</div>
	
	
	<?php echo $this->renderElement("admin_footer"); ?>
