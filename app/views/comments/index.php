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

			<h2>Panel de administraci&oacute;n<span> (editar y eliminar)</span></h2>
			<div class="inner-box clearfix">

				<div id="sidebar">

					<ul>
						<li class="head">Herramientas</li>
						<li>
							<?php echo $this->html->linkTo("Posts", "admin/", " title=\"Administrar los posts\""); ?>
						</li>
						<li class="current">
							<?php echo $this->html->linkTo("Comentarios", "comments/", " title=\"Administrar los comentarios\""); ?>
						</li>
						<li>
							<?php echo $this->html->linkTo("Enlaces", "admin/comments/", " title=\"Administrar los enlaces\""); ?>
						</li>
					</ul>

				</div>

				<div id="table-block">

					<table cellspacing="0" cellpadding="0">
					<tbody>
						<?php
						if ($comments == null) {
						?>
							<div class="error">
								No hay comentarios
							</div>
						<?php
						} else {
						?>
							<tr class="header">
								<td>Contenido</td>
								<td>Estado</td>
								<td>Acciones</td>
							</tr>
						<?php
							$odd = false;
							foreach ($comments as $comment) { 
								$alt = ($odd) ? "class=\"alternate\"" : "" ;
								$status = ($comment["status"] == "publish") ? "<td class=\"true\">published</td>" : "<td class=\"false\">waiting</td>" ;
						?>
							<tr <?php echo $alt; ?> id="reg<?php echo $comment["ID"];?>">
								<td>
									<?php echo $comment["content"]; ?><br>
									<strong><?php echo $this->l10n->__("View post");?></strong>:
									<?php echo $this->html->linkTo("\"{$comment["post"]["title"]}\"", $comment["post"]["urlfriendly"]."/", " title=\"View posst\" target=\"_blank\""); ?>
								</td>
								<?php echo $status; ?>
								<td class="actions">
									<?php
										echo $this->html->linkTo("Editar","comments/edit/{$comment["ID"]}","class=\"edit\" title=\"{$comment["ID"]}\"");
										echo $this->html->linkTo("Borrar","comments/remove/{$comment["ID"]}","class=\"remove\" title=\"{$comment["ID"]}\"");
										echo $this->html->linkTo("Aprobar","comments/approve/{$comment["ID"]}","class=\"approve\" title=\"{$comment["ID"]}\"");
									?>
								</td>
							</tr>
						<?php
								$odd = !$odd;
							} 
						} 
						?>
					</tbody>
				</table>

				<?php echo $pagination; ?>
				</div>

			</div>

		</div>

	<?php echo $this->renderElement("admin_footer"); ?>
