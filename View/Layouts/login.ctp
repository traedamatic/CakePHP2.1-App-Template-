<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php echo Configure::read('SiteSettings.title'); ?> - Login </title>
  <meta name="viewport" content="width=device-width">
  <?php
		echo $this->Html->meta('icon');
		echo $this->Csscrush->tag("/css/manager.css");
		echo $this->fetch('meta');
		echo $this->fetch('css');				
	?>
</head>
<body class="login-layout">
	<!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
	
	<div id="flash">
		<?php
			echo $this->Session->flash('auth');			
		?>
	 </div>
	
  <div id="container">
	 	 
	 
	 
	 <div id="login" role="main">
	  <?php echo $this->fetch('content'); ?>
	 </div>
	 	 
  </div>
	
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.min.js"><\/script>')</script>

	<?php
		echo $this->Html->script('plugins');
		echo $this->Html->script('script');
			
		echo $this->fetch('script');
		
		echo $this->Js->writeBuffer();
	?>  
</body>
</html>
