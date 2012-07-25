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
              
//              $(".alert-message").alert();
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

    <?php echo $this->renderElement("admin_topbar"); ?>
    <?php 
        // elemento que muestra los mensajes del sistema al usuario
        $this->renderElement('messages'); 
    ?>
    <div class="container">    
        <div class="content">
          <?php echo $content_for_layout ?>
        </div>

        <?php echo $this->renderElement("admin_footer"); ?>
    </div>
    </body>
</html>
