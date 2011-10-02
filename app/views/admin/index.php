		<h1>Codice CMS Dashboard</h1>
		
		<h2>Panel de administraci&oacute;n<span> (editar y eliminar)</span></h2>
			
				<table class="zebra-striped">
					<thead>
						<tr>
							<th>Title</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($posts as $post) { ?>
							<tr id="row<?php echo $post["ID"]; ?>">
								<td><?php echo $post["title"]; ?></td>
								<td><?php echo $post["status"]; ?></td>
								<td>
									<?php echo $this->html->linkTo("Editar","admin/edit/{$post["ID"]}"); ?>
									<?php echo $this->html->linkTo("Borrar","admin/remove/{$post["ID"]}"); ?>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
				
				<?php echo $pagination; ?>

	<?php echo $this->renderElement("admin_footer"); ?>
