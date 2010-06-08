<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
	<meta name="generator" content="Codice CMS" />
	<?php echo $this->html->includeCss("stan512/style"); ?>
	<?php echo $this->html->includeJs("jquery"); ?>
	<script> var relativePathToApp = "<?php echo relativePathToApp; ?>"; </script>
	<?php echo $this->html->includeJs("codice/jquery.scrollTo-min"); ?>
	<?php echo $this->html->includeJs("codice/php.pack"); ?>
	<?php echo $this->html->includeJs("codice/codice"); ?>
	<?php echo $includes; ?>
	<title><?php echo $title_for_layout; ?></title>
</head>
<body>
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
