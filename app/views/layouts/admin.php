<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<title><?php echo $title_for_layout; ?></title>
		<meta name="generator" content="flavorPHP" />
		<?php echo $this->html->charsetTag("UTF-8"); ?>
		<link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.3.0/bootstrap.min.css">
    
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
            <li><a href="#about">Posts</a></li>
            <li><a href="#contact">Comments</a></li>
            <li><a href="#contact">Configuration</a></li>
            <li><a href="#contact">Logout</a></li>
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
            <li><a href="#">Entries</a></li>
            <li><a href="#">Comments</a></li>
            <li><a href="#">Bookmarks</a></li>
            <li><a href="#">Upladed files</a></li>
            <li><a href="#">Codice 	configuration</a></li>
          </ul>
        </div>
    </div>
    <div class="content">
      <?php echo $content_for_layout ?>
    </div>
  </div>


	</body>
</html> 
