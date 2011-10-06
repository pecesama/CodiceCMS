<h1>Last entries</h1>

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
				<td><?php echo $this->html->linkTo($post["title"],"entries/update/{$post["ID"]}"); ?></td>
				<td><?php echo $post["status"]; ?></td>
				<td><?php echo $this->html->linkTo("Edit","entries/update/{$post["ID"]}"," rel='twipsy' class='btn primary' title='Modify the content of this entry'"); ?></td>
				<td><?php echo $this->html->linkTo("Remove","entries/delete/{$post["ID"]}"," rel='twipsy' class='btn danger' title='Removes this entry.'"); ?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<?php echo $pagination; ?>

<?php echo $this->renderElement("admin_footer"); ?>