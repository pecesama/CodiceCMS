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
				<td><?php echo $this->html->linkTo($post["title"],"posts/update/{$post["idPost"]}"); ?></td>
				<td><?php echo $post["idStatus"]; ?></td>
				<td><?php echo $this->html->linkTo("Edit","posts/update/{$post["idPost"]}"," rel='twipsy' class='btn primary' title='Modify the content of this entry'"); ?></td>
				<td><?php echo $this->html->linkTo("Remove","posts/delete/{$post["idPost"]}"," rel='twipsy' class='btn danger' title='Removes this entry.'"); ?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<?php echo $pagination; ?>