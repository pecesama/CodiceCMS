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
				<td><?php echo $this->html->linkTo("Edit","comments/edit/{$comment["ID"]}"," class='btn primary' rel='twipsy' title='Modify the content of this comment before publishing it.'"); ?></td>
				<td><?php echo $this->html->linkTo("Remove","comments/remove/{$comment["ID"]}"," class='btn danger' rel='twipsy' title='Remove this comment.'"); ?></td>
				<td><?php echo $this->html->linkTo("Approve","comments/approve/{$comment["ID"]}"," class='btn success' rel='twipsy' title='Approve this comment.'"); ?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<?php echo $pagination; ?>
				
<?php echo $this->renderElement("admin_footer"); ?>
