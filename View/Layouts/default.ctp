<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php echo $title_for_layout; ?></title>
  <meta name="description" content="">

  <meta name="viewport" content="width=device-width">
  <?php
		echo $this->Html->meta('icon');

		echo $this->Html->css("style");

		echo $this->fetch('meta');
		echo $this->fetch('css');
		
		echo $this->Html->script('libs/modernizr-2.6.2');
	?>
</head>
<body>
  <!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
  <div id="container">
	 <header>
	  <h1>App Template for CakePHP 2.2</h1>
	  <p>-> fast fun with CakePHP</p>
	 </header>
	 <div role="main">
	  <?php echo $this->fetch('content'); ?>
	 </div>
	 
	 <footer>
	 <p>AppTemplate for CakePHP 2.X | follow on <?php echo $this->Html->link('Github','https://github.com/traedamatic/CakePHP2.1-App-Template-',array('target' => '_blank')); ?></p> 
	 <?php echo $this->Html->link(
						  $this->Html->image('cake.power.gif', array('alt' => "CakePHP", 'border' => '0')),
						  'http://www.cakephp.org/',
						  array('target' => '_blank', 'escape' => false)
					  );
				  ?>
	  
	 </footer>
  </div>
	
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.8.3.min.js"><\/script>')</script>

	<?php
		echo $this->Html->script('plugins');
		
		echo $this->Html->script('main');
			
		echo $this->fetch('script');
		
		echo $this->Js->writeBuffer();
	?>  
</body>
</html>
