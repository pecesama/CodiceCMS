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

<style>
/* Based on http://meyerweb.com/eric/tools/css/reset/ */
.resetCSS input, .resetCSS div, .resetCSS span, .resetCSS applet, .resetCSS object, .resetCSS iframe,
.resetCSS h1, .resetCSS h2, .resetCSS h3, .resetCSS h4, .resetCSS h5, .resetCSS h6, .resetCSS p, .resetCSS blockquote, .resetCSS pre,
.resetCSS a, .resetCSS abbr, .resetCSS acronym, .resetCSS address, .resetCSS big, .resetCSS cite, .resetCSS code,
.resetCSS del, .resetCSS dfn, .resetCSS em, .resetCSS img, .resetCSS ins, .resetCSS kbd, .resetCSS q, .resetCSS s, .resetCSS samp,
.resetCSS small, .resetCSS strike, .resetCSS strong, .resetCSS sub, .resetCSS sup, .resetCSS tt, .resetCSS var,
.resetCSS b, .resetCSS u, .resetCSS i, .resetCSS center,
.resetCSS dl, .resetCSS dt, .resetCSS dd, .resetCSS ol, .resetCSS ul, .resetCSS li,
.resetCSS fieldset, .resetCSS form, .resetCSS label, .resetCSS legend,
.resetCSS table, .resetCSS caption, .resetCSS tbody, .resetCSS tfoot, .resetCSS thead, .resetCSS tr, .resetCSS th, .resetCSS td,
.resetCSS article, .resetCSS aside, .resetCSS canvas, .resetCSS details, .resetCSS embed, 
.resetCSS figure, .resetCSS figcaption, .resetCSS footer, .resetCSS header, .resetCSS hgroup, 
.resetCSS menu, .resetCSS nav, .resetCSS output, .resetCSS ruby, .resetCSS section, .resetCSS summary,
.resetCSS time, .resetCSS mark, .resetCSS audio, .resetCSS video {
  margin: 0;
  padding: 0;
  
  
  /*font-size: 100%;
  font: inherit;
  vertical-align: baseline;*/
}
/* HTML5 display-role reset for older browsers */
.resetCSS article, .resetCSS aside, .resetCSS details, .resetCSS figcaption, .resetCSS figure, 
.resetCSS footer, .resetCSS header, .resetCSS hgroup, .resetCSS menu, .resetCSS nav, .resetCSS section {
  display: block;
}
.resetCSS ol, .resetCSS ul {
  list-style: none;
}
.resetCSS blockquote, .resetCSS q {
  quotes: none;
}
.resetCSS blockquote:before, .resetCSS blockquote:after,
.resetCSS q:before, .resetCSS q:after {
  content: '';
  content: none;
}
.resetCSS table {
  border-collapse: collapse;
  border-spacing: 0;
}
</style>

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
			<h2><?php echo $codice["blog_description"]; ?></h2>

			<ul class="tabs">
			  <li><?php echo $this->html->linkTo("Home"); ?></li>
			  <li><?php echo $this->html->linkTo("RSS","feed/rss"); ?></li>
			</ul>

			<?php echo $content_for_layout; ?>
			<?php echo $this->renderElement("index_internalSidebars"); ?>
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
