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
  <title>AppTemplate for Cakephp2.X - <?php echo $title_for_layout; ?></title>
  <meta name="viewport" content="width=device-width">
  <?php
		echo $this->Html->meta('icon');
		echo $this->Csscrush->tag("/css/manager.css");
		echo $this->fetch('meta');
		echo $this->fetch('css');		
		echo $this->Html->script('libs/modernizr-2.5.3.min');
	?>
</head>
<body>
  <!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
  <div id="container">
	 <header>
	  <h1>App Template for CakePHP 2.X Manager Layout</h1>
	  <p>-> You can customize this layout by editing the file View/Layouts/manager.ctp</p>
	  <?php $username = AuthComponent::user('username') ;if(!empty($username)) echo $this->Html->link(_('Logout'),array('controller' => 'users', 'action' => 'logout','manager' => false,'plugin' => false),array('id' => 'btn-logout', 'class' => 'button red')); ?>
	 </header>
	 <nav>
		<?php echo $this->Html->link(_('Users'),array('controller' => 'users', 'action' => 'index','manager' => true,'plugin' => false)); ?>
		<?php echo $this->Html->link(_('Site-Routes'),array('controller' => 'routes', 'action' => 'index','manager' => true,'plugin' => 'siteconfig')); ?>
		<?php echo $this->Html->link(_('Site-Settings'),array('controller' => 'settings', 'action' => 'index','manager' => true,'plugin' => 'siteconfig')); ?>
		<?php echo $this->Html->link(_('Nginx Conf'),array('controller' => 'pages', 'action' => 'nginx','manager' => false,'plugin' => false)); ?>
	 </nav>
	 
	 <div id="flash">
		<?php
			echo $this->Session->flash('auth');
			echo $this->Session->flash();
		?>
	 </div>
	 
	 <div id="content" role="main">
	  <?php echo $this->fetch('content'); ?>
	 </div>
	 
	 <footer>
		<p>AppTemplate for CakePHP 2.X | fork,contribute or follow on <?php echo $this->Html->link('Github','https://github.com/traedamatic/CakePHP2.1-App-Template-',array('target' => '_blank')); ?></p>
	  <?php echo $this->Html->link(
						  $this->Html->image('cake.power.gif', array('alt' => "CakePHP", 'border' => '0')),
						  'http://www.cakephp.org/',
						  array('target' => '_blank', 'escape' => false)
					  );
				  ?>
	 </footer>
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
