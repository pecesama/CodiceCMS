<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <?php echo $this->html->charsetTag("UTF-8"); ?>
    <title>Codice Setup</title>
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
</head>
<body>

	<div class="container">
		<div class="row">
			<h1>Codice CMS</h1>
			<h2>Setup</h2>
			<h3>Step 1 of 3</h3>
		</div>
		<div class="row">
			<div class="span">
				<form method="post">
					<fieldset>
						<legend>Installation Directory Details</legend> 

						Installation directory <?php echo Flavor_Path; ?><br />
						Permissions on Installation directory: <span class="label"><?php echo $flavor_path_permissions; ?></span><br />
						Installation directory owner: <span class="label"><?php echo $flavor_path_owner['name']?></span> (<?php echo $flavor_path_owner['gecos']; ?>)<br />
					</fieldset>

					<fieldset>
						<legend>Installation details</legend>

						<label for="input-database-server">Database server</label> <input type="text" id="input-database-server" name="database[server]" value="localhost"><br />
						<label for="input-database-user">Database user</label> <input type="text" id="input-database-user" name="database[user]" value="root"><br />
						<label for="input-database-password">Database password</label> <input type="password" value="" id="input-database-password" name="database[password]"><br />
						<label for="input-database-name">Database name</label> <input type="text" id="input-database-name" name="database[name]"><br />
						<label for="input-database-port">Database port</label> <input type="text" id="input-database-port" name="database[port]" value="FALSE"><br />
						<label for="input-codice-path">Path to Codice</label> <input type="text" id="input-codice-path" name="codice[path]" value="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>"><br />
						<br />
					</fieldset>
					<input type="submit" value="Go to the step 2">
				</form>
			</div>
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
