<table class="zebra-striped">
	<thead>
		<tr>
			<th>Title</th>
			<th>Status</th>
			<th colspan="2">Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($posts as $post) { ?>
			<tr id="row<?php echo $post["ID"]; ?>">
				<td><?php echo $post["title"]; ?></td>
				<td><?php echo $post["status"]; ?></td>
				<td><?php echo $this->html->linkTo("Edit","admin/edit/{$post["ID"]}"," rel='twipsy' class='btn primary' title='Modify the content of this entry'"); ?></td>
				<td><?php echo $this->html->linkTo("Remove","admin/remove/{$post["ID"]}"," rel='twipsy' class='btn danger' title='Removes this entry.'"); ?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<?php echo $pagination; ?>

<?php echo $this->renderElement("admin_footer"); ?>