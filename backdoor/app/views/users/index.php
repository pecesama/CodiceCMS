<h1>Users</h1>

<table class="zebra-striped">
	<thead>
		<tr>
			<th>Id</th>
			<th>User</th>
			<th>Email</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Created</th>
			<th colspan="3">Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($users as $user) : ?>
			<tr id="row<?php echo $user["idUser"];?>">
				<td><?php echo $user['idUser']; ?></td>
				<td><?php echo $this->html->linkTo($user['user'], "users/update/{$user['idUser']}"); ?></td>
				<td><?php echo $user['email']; ?></td>
				<td><?php echo $user['firstName']; ?></td>
				<td><?php echo $user['lastName']; ?></td>
				<td><?php echo $user['created']; ?></td>

				<td><?php echo $this->html->linkTo("Edit or View profile","users/update/{$user["idUser"]}"," class='btn primary' rel='twipsy' title='To modify or view the profile of this user.'"); ?></td>
				<td><?php echo $this->html->linkToConfirm("Remove","users/remove/{$user["idUser"]}"," class='btn danger' rel='twipsy' title='Remove this user.'"); ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?php echo $pagination; ?>