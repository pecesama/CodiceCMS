<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<title><?php echo $title_for_layout; ?></title>
		<meta name="generator" content="flavorPHP" />
		<?php echo $this->html->charsetTag("UTF-8"); ?>
		<link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.3.0/bootstrap.min.css">
    <?php echo $this->html->includeJs("bootstrap-popover"); ?>

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le styles -->
    <style type="text/css">
      body {
        padding-top: 60px;
      }
    </style>
	</head> 
	<body> 

    <div class="topbar">
      <div class="fill">
        <div class="container">
          <a class="brand" href="#">Codice CMS</a>
          <ul class="nav">
            <li class="active"><a href="#">Home</a></li>
            <li><?php echo $this->html->linkTo("Posts","admin");?></li>
            <li><?php echo $this->html->linkTo("Comments","comments"); ?></li>
            <li><?php echo $this->html->linkTo("Configuration","admin/config"); ?></li>
            <li><?php echo $this->html->linkTo("Logout","admin/logout"); ?></li>
          </ul>
           <p class="pull-right">Logged in as <a href="#">username</a></p>
        </div>
      </div>
    </div>

  <div class="container-fluid">
    <div class="sidebar">
       <div class="well">
          <h5>Manage</h5>
          <ul>
            <li><?php echo $this->html->linkTo("Entries","admin"); ?>
              <ul>
                <li><?php echo $this->html->linkTo("Add","admin/add"); ?></li>
              </ul>
            </li>
            <li><?php echo $this->html->linkTo("Comments","comments"); ?></li>
            <li><?php echo $this->html->linkTo("Bookmarks","#"); ?></li>
            <li><?php echo $this->html->linkTo("Uploaded files","#"); ?></li>
            <li><?php echo $this->html->linkTo("Configuration","admin/config"); ?></li>
          </ul>
        </div>
    </div>
    <div class="content">
      <?php echo $content_for_layout ?>
    </div>
  </div>


	</body>
</html> 
