<table class="zebra-striped">
	<thead>
		<tr>
			<th>Content</th>
			<th>Publishing status</th>
			<th colspan="3">Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($comments as $comment) { ?>
			<tr id="row<?php echo $comment["ID"];?>">
				<td><?php echo $comment["content"]; ?></td>
				<td><?php echo $comment["status"]; ?></td>
				<td><?php echo $this->html->linkTo("Editar","comments/edit/{$comment["ID"]}"," title=\"{$comment["ID"]}\" class='btn primary'"); ?></td>
				<td><?php echo $this->html->linkTo("Borrar","comments/remove/{$comment["ID"]}"," title=\"{$comment["ID"]}\" class='btn danger'"); ?></td>
				<td><?php echo $this->html->linkTo("Aprobar","comments/approve/{$comment["ID"]}"," title=\"{$comment["ID"]}\" class='btn success'"); ?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<?php echo $pagination; ?>
				
<?php echo $this->renderElement("admin_footer"); ?>
