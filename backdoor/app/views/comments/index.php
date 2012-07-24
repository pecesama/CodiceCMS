<h1>Last comments</h1>

<table class="zebra-striped">
	<thead>
		<tr>
			<th>Content</th>
			<th>Publishing status</th>
			<th colspan="3">Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php if(count($comments) > 0): ?>
		<?php foreach ($comments as $comment) : ?>
			<tr id="row<?php echo $comment["ID"];?>">
				<td><?php echo $comment["content"]; ?></td>
				<td><?php echo $comment["status"]; ?></td>
				<td><?php echo $this->html->linkTo("Edit","comments/update/{$comment["idComment"]}"," class='btn primary' rel='twipsy' title='Modify the content of this comment before publishing it.'"); ?></td>
				<td><?php echo $this->html->linkTo("Remove","comments/delete/{$comment["idComment"]}"," class='btn danger' rel='twipsy' title='Remove this comment.'"); ?></td>
				<td><?php echo $this->html->linkTo("Approve","comments/approve/{$comment["idComment"]}"," class='btn success' rel='twipsy' title='Approve this comment.'"); ?></td>
			</tr>
		<?php endforeach; ?>
		<?php else: ?>
			<tr>
				<td colspan="5">No comment to show.</td>
			</tr>
		<?php endif; ?>
	</tbody>
</table>

<?php echo $pagination; ?>
