<?php if($this->User->isLogged()){ ?>
    <div class="topbar">
      <div class="fill">
        <div class="container">
          <?php echo $this->html->linkTo("Codice CMS","index","class='brand'");?>
          
          <ul class="nav">
            <li class="dropdown active">
              <?php echo $this->html->linkTo("Entries","#"," class='dropdown-toggle'"); ?>
              <ul class="dropdown-menu">
                <li><?php echo $this->html->linkTo("Last entries","posts"); ?></li>
                <li><?php echo $this->html->linkTo("Add entry","posts/create"); ?></li>
              </ul>
            </li>
            <li class="dropdown">
              <?php echo $this->html->linkTo("Comments","#"," class='dropdown-toggle'"); ?>
              <ul class="dropdown-menu">
                <li><?php echo $this->html->linkTo("Last comments","comments"); ?></li>
                <li><?php echo $this->html->linkTo("Waiting for approval","comments/waiting"); ?></li>
              </ul>
            </li>
            <li><a href="index/about">About</a></li>
          </ul>

          <form action="">
             <input type="text" placeholder="Search" />
          </form>

          <ul>
            <li><?php echo $this->html->linkTo("Logout","login/logout"); ?></li>
          </ul>

          <p class="pull-right">Logged in as <a href="#">username</a></p>
        </div>
      </div>
    </div>
<?php } ?>