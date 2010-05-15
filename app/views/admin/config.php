	<?php echo $this->renderElement("admin_header"); ?>

    <div id="page-navigation" class="clearfix">
			
			<ul>				
				<li>
					<?php echo $this->html->linkTo("Administrar posts", "admin/", " title=\"Administrar los posts\""); ?>
				</li>
				<li>
					<?php echo $this->html->linkTo("Administrar comentarios", "comments/", " title=\"Administrar los comentarios\""); ?>
				</li>
				<li>
					<?php echo $this->html->linkTo("Agregar post", "admin/add/", " title=\"Agregar un nuevo post\""); ?>
				</li>
				<li class="current">
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
			
			<h2>Configuration</h2> 
			<div class="inner-box clearfix">
			
				<div id="form-block"> 
									
					<?php echo $this->html->form("admin/config"); ?>
						
						<h3>Blog configuration</h3>
						
						<?php
						foreach($conf as $name => $value){
							echo "<label for=\"$name\">$name</label>";
							echo $this->html->textField($name, " value=\"$value\" class=\"medium\" ");
						}
						?>
						
						<h3>User configuration</h3>

						<?php
						foreach($userConf as $name => $value){
							echo "<label for=\"$name\">$name</label>";
							echo $this->html->textField($name, " value=\"$value\" class=\"medium\" ");
						}
						?>
						
						<input class="submit reset" id="cancelar" name="cancelar" type="submit" value="Cancelar">
						<input class="submit" type="submit" value="Modificar" /> 

						</form>
				
				</div>
			
			</div> 
		</div>
	
	
	<?php echo $this->renderElement("admin_footer"); ?>
