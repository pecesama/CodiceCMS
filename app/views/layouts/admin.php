<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <?php echo $this->html->charsetTag("UTF-8"); ?>
    <title><?php echo $title_for_layout; ?></title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="flavorPHP" />
		<link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.3.0/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    
    <?php echo $this->html->includeJs("bootstrap/dropdown"); ?>
    <?php echo $this->html->includeJs("bootstrap/twipsy"); ?>
    <?php echo $this->html->includeJs("bootstrap/popover"); ?>

          <script>
            $(function () {
              $("a[rel=twipsy]").twipsy();
              $("a[rel=popover]")
                .popover({
                  offset: 10
                })
                .click(function(e) {
                  e.preventDefault()
                });
              $(".topbar").dropdown();
            });
          </script>

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
          <?php echo $this->html->linkTo("Codice CMS","index","class='brand'");?>
          
          <ul class="nav">
            <li class="dropdown active">
              <?php echo $this->html->linkTo("Entries","#"," class='dropdown-toggle'"); ?>
              <ul class="dropdown-menu">
                <li><?php echo $this->html->linkTo("Last entries","admin"); ?></li>
                <li><?php echo $this->html->linkTo("Add entry","admin/add"); ?></li>
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

          <p class="pull-right">Logged in as <a href="#">username</a></p>
        </div>
      </div>
    </div>

  <div class="container">
    
    <div class="content">
      <?php echo $content_for_layout ?>
    </div>
  </div>

	</body>
</html>