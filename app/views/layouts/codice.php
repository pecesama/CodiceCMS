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

    <!-- Le styles -->
    <style type="text/css">
      body {
        padding-top: 60px;
      }
    </style>
	<?php echo $includes; ?>
</head>
<body>
	
	<?php echo $this->renderElement("topbar"); ?>

	<div class="container">
		<div class="content">
			<h1><?php echo $this->html->linkTo($codice["blog_name"]); ?></h1>

			<h2><?php echo $this->html->linkto($codice["blog_description"]); ?></h2>
		</div>
	</div>

<?php exit; ?>

	<div id="todo">
		<div id="header">
			<h1><?php echo $this->html->linkTo($codice["blog_name"]); ?></a></h1>
			<h2><?php echo $this->html->linkto($codice["blog_description"]); ?></h2>
		</div><!-- header -->
		<div id="topnav">
			<p>
				<?php echo $this->html->linkTo("Inicio"); ?>
				<?php echo $this->html->linkTo("¿Sidebar?","#sidebars"); ?>
				<?php echo $this->html->linkTo("RSS","feed/rss"); ?>
			</p>
		</div><!-- topnav -->
		<div id="columnas" class="clearfix">
			<div id="contenido">
				<?php echo $content_for_layout ?>
			</div><!-- contenido -->
			<?php echo $this->renderElement("index_internalSidebars"); ?>
		</div><!-- columnas -->
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
