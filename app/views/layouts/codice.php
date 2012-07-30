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
  <?php echo $this->html->includeCss('pagination'); ?>
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
        /*padding-top: 60px;*/
      }
    </style>
	<?php echo $includes; ?>
</head>
<body>
	
	<?php //echo $this->renderElement("admin_topbar"); ?>

	<div class="container">
		<div class="row">
			<h1><?php echo $this->html->linkTo($config["blogName"]); ?></h1>
			<h2><?php echo $config["description"]; ?></h2>

			<?php echo $this->renderElement("index_tabs"); ?>
		</div>
		<div class="row">
			<div class="span10">
				<?php if($this->session->issetFlash()): ?>
					<div class="alert-message fade in">
						<a class="close" href="#">×</a>
						<?php echo $this->session->getFlash(); ?>
					</div>
				<?php endif; ?>
				<?php echo $content_for_layout; ?>
			</div>
			<div class="span4">
				<?php echo $this->renderElement("index_sidebar"); ?>
			</div>
		</div>
	</div>
</body>
</html>
