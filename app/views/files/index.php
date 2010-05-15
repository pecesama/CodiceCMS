
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
		
		<h2>Panel de administraci&oacute;n de archivos</h2>
		<div class="inner-box clearfix">
		
			<div id="sidebar">
				
				<ul>
					<li class="head">Herramientas</li>
					<li>
						<?php echo $this->html->linkTo("Posts", "admin/", " title=\"Administrar los posts\""); ?>
					</li>
					<li>
						<?php echo $this->html->linkTo("Comentarios", "comments/", " title=\"Administrar los comentarios\""); ?>
					</li>
					<li>
						<?php echo $this->html->linkTo("Enlaces", "admin/comments/", " title=\"Administrar los enlaces\""); ?>
					</li>
					<li class="current">
						<?php echo $this->html->linkTo("Archivos", "files/index/", " title=\"Administrar los archivos\""); ?>
					</li>
				</ul>				
			
			</div>
			
			<div id="table-block">
				
				<?php if ($this->session->issetFlash()) { ?>
					<div class="error">
						<?php echo $this->session->getFlash(); ?>
 					</div>
				<?php } ?>
				
				<?php echo $this->html->formFiles('files/add') ?>
				<?php
				if(isset($status)){
					echo '<p>'.$status.'</p>';
				}
				?>
				<label for="file"><?php echo $this->l10n->__("Nuevo archivo") ?></label>
				<input type="file" name="new_file" id="file" <?php echo ($disableUploadForm)? 'disabled="disabled"' : ''?> />
					<?php echo $this->html->linkTo($this->l10n->__("Opciones"),'#','title="'.$this->l10n->__("Mostrar opciones").'" class="option_grid_trigger"');?>
				<div id="file_options" class="option_grid grid_2">
					<?php  /*?>
					<div class="column">
						<label for="thumbnail"><?php echo $this->l10n->__("Generar Thumbnail"); ?></label>
						<input type="checkbox" name="thumbnail" value="true" id="thumbnail" class="checkbox"/>
						<p class="info"><?php echo $this->l10n->__("Si es una imagen, Se generar&aacute; una miniatura de 100x100px (TODO)"); ?></p>
					</div>
					<?php  */?>
					<div class="column">
						<label for="hotlinking"><?php echo $this->l10n->__("Prevenir Hotlinking"); ?></label>
						<input type="checkbox" name="hotlinking" value="true" id="hotlinking" checked="checked" class="checkbox" />
						<p class="info"><?php echo $this->l10n->__("Este archivo s&oacute;lo se podr&aacute; acceder desde este sitio."); ?></p>
					</div><?php  /*?>
					<div class="column">
						<label for="statistics"><?php echo $this->l10n->__("Registrar estad&iacute;sticas"); ?></label>
						<input type="checkbox" name="statistics" value="true" id="statistics" checked="checked"  class="checkbox"/>
					</div><?php  */?>
					<div class="column">
						<label for="password"><?php echo $this->l10n->__("Contrase&ntilde;a"); ?></label>
						<input type="password" name="password" value="" id="password" />
					</div>					
					<div class="grid_footer"></div>
				</div>
				<input type="submit" class="submit" name="upload" value="<?php echo $this->l10n->__("Subir"); ?>" id="upload" style="margin-top:10px">
				</form>
				
				
			<div style="clear:left; position:relative;">&nbsp;</div>
				<br>
				<table cellspacing="0" cellpadding="0">
				<tbody>						
					<?php
					if (false) {
					?>						
						<div class="error">
							<?php echo $this->l10n->__("No hay comentarios") ?>
		                </div>
					<?php
					} else {
					?>
						<tr class="header">
							<td><?php echo $this->l10n->__("Archivo") ?></td>
							<td style="width:150px"><?php echo $this->l10n->__("Acciones") ?></td>
						</tr>
					<?php
						$odd = false;
						foreach ($files as $file) { 
							$alt = ($odd) ? "alternate" : "" ;
					?>
						<tr class="<?php echo $alt; ?>">
							<td>
								<?php if(!empty($file["password"])){ ?>
									(*)	
								 <?php } ?>
								<?php echo $file["name"]; ?>
							</td>
							<td class="actions">
								<?php 
									echo $this->html->imageLinkConfirm($this->l10n->__("Remove"), 'files/remove/'.$file["id_file"]."", "delete.png", "Remove");
									echo $this->html->imageLink($this->l10n->__("Password"), '#',"class=\"lock_show\"", "lock.png", "Password");
									if($file['stats'] == 1 && 0){
									echo $this->html->imageLink($this->l10n->__("Stats"), 'files/stats/'.$file["id_file"],"", "stats.png", "Stats");	
									}
									echo $this->html->imageLink($this->l10n->__("View file"),'files/get/'.$file["id_file"].'/'.$file["name"], "target=\"_blank\"", "right.png", "View File");
								
								?>
							</td>
						</tr>
						<tr class="option" style="display:none;">
							<td colspan="2">
								<?php echo $this->html->form('files/change_password/'.$file['id_file']) ?>
								<?php echo $this->l10n->__("Cambiar password:"); ?> <input type="password" name="new_password" />
								<input type="submit" name="change_password" value="<?php echo $this->l10n->__("Cambiar"); ?>">
								</form>
							</td>
						</tr>
					<?php
							$odd = !$odd;
						} 
					} 
					?>
				</tbody>
			</table>
			<input type="submit" class="submit" name="multydelete" value="<?php echo $this->l10n->__("Borrar"); ?>" id="multydelete" style="margin-top:10px">
			<?php echo $pagination; ?>
			</div>
		
		</div>
			
	</div>

<?php echo $this->renderElement("admin_footer"); ?>
