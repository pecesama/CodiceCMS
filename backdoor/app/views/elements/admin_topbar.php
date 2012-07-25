<?php if($this->User->isLogged()){ ?>
	<div class="topbar">
		<div class="fill">
			<div class="container">
				<?php echo $this->html->linkTo("Codice CMS","index","class='brand'");?>

				<ul class="nav">
					<li class="dropdown <?php echo isset($active['entries'])? $active['entries'] : ""; ?>">
						<?php echo $this->html->linkTo("Entries","#"," class='dropdown-toggle'"); ?>
						<ul class="dropdown-menu">
							<li><?php echo $this->html->linkTo("Last entries","posts"); ?></li>
							<li><?php echo $this->html->linkTo("Add entry","posts/create"); ?></li>
						</ul>
					</li>
					<li class="dropdown <?php echo isset($active['comments'])? $active['comments'] : ""; ?>">
						<?php echo $this->html->linkTo("Comments","#"," class='dropdown-toggle'"); ?>
						<ul class="dropdown-menu">
							<li><?php echo $this->html->linkTo("Last comments","comments"); ?></li>
							<li><?php echo $this->html->linkTo("Waiting for approval","comments/waiting"); ?></li>
						</ul>
					</li>
					<li class="dropdown <?php echo isset($active['users'])? $active['users'] : ""; ?>">
						<?php echo $this->html->linkTo("Users","#"," class='dropdown-toggle'"); ?>
						<ul class="dropdown-menu">
							<li><?php echo $this->html->linkTo("Users","users"); ?></li>
							<li><?php echo $this->html->linkTo("Add user","users/add"); ?></li>
						</ul>
					</li>
					<li><?php echo $this->html->linkTo("About","index/about"); ?></li>
				</ul>

				<form action="">
					<input type="text" placeholder="Search" />
				</form>

				<ul>
					<li><?php echo $this->html->linkTo("Logout","login/logout"); ?></li>
				</ul>

				<p class="pull-right">Logged in as <a href="#"><?php echo $this->session->user['user']; ?></a></p>

			</div>
		</div>
	</div>
<?php } ?>
