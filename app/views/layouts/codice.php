<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<?php echo $this->html->charsetTag("UTF-8"); ?>
		<?php echo $this->html->includeCss('codice'); ?>
		<?php echo $this->html->includeCss('pagination'); ?>
		<?php echo $this->html->includeCss('bootstrap.min'); ?>
		<?php //echo $this->html->includeCss('bootstrap-responsive.min'); ?>
		<?php echo $includes; ?>
		<meta name="generator" content="Codice CMS" />
		<meta name="description" content="">
		<meta name="author" content="">
		<title><?php echo $title_for_layout; ?></title>
	</head>
	<body>

		<div class="container" id="codice">
			<div class="row" id="header">
				<?php //echo $this->renderElement('header'); ?>
			</div>

			<div class="row" id="content">
				<div id="messages" class="span12">
					<?php $this->renderElement("flash"); ?>
				</div>

				<div id="entries" class="span12">
					<?php echo $content_for_layout; ?>
				</div>

				<div id="navigation" class="span12">
					<?php echo $this->renderElement("navigation"); ?>
				</div>
			</div>
			<div class="row" id="footer">
				<?php //echo $this->renderElement('footer'); ?>
			</div>
		</div>

		<?php echo $this->html->includeJs("jquery"); ?>
		<?php echo $this->html->includeJs("bootstrap"); ?>
		<?php echo $this->html->includeJs("bootstrap/dropdown"); ?>
		<?php echo $this->html->includeJs("bootstrap/twipsy"); ?>
		<?php echo $this->html->includeJs("bootstrap/popover"); ?>
	</body>
</html>
