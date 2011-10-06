<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <?php echo $this->html->charsetTag("UTF-8"); ?>
    <title><?php echo $title_for_layout; ?></title>
   	<meta name="generator" content="Codice CMS" />
	<meta name="description" content="">
    <meta name="author" content="">
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
          
    <!-- Le styles -->
    <style type="text/css">
      body {
        padding-top: 60px;
      }
    </style>
	<?php echo $includes; ?>
</head>
<body>
	
	<?php echo $this->renderElement("admin_topbar"); ?>

	<div class="container-fluid">
		<div class="sidebar">
			<?php echo $this->renderElement("index_sidebar"); ?>
		</div>
		<div class="content">
			<h1><?php echo $this->html->linkTo($config["blog"]["blog_name"]); ?></h1>
			<h2><?php echo $config["blog"]["blog_description"]; ?></h2>

			<?php echo $this->renderElement("index_tabs"); ?>

			<?php echo $content_for_layout; ?>
		</div>
	</div>
	
	<div id="fb-root"></div>
	<script src="http://connect.facebook.net/en_US/all.js"></script>
	<script>FB.init({appId  : '127934697222671',status : true,cookie : true,xfbml  : true});</script>
	<script type="text/javascript">
	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
	document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
	</script>
	<script type="text/javascript">
	try {
	var pageTracker = _gat._getTracker("UA-256387-1");
	pageTracker._trackPageview();
	} catch(err) {}</script>
</body>
</html>
