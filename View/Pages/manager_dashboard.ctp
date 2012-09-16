<div class="view" id="manager-dashboard">
	<h1><?php echo __('Welcome to the Manager Dashboard')?></h1>
	<p>This manager dashboard gives you some information about core manager
	function <br/>These plugins or controller are already included:</p>
	<ul>
		<li><?php echo $this->Html->link(_('Users'),array('controller' => 'users', 'action' => 'index','manager' => true,'plugin' => false)); ?></li>
		<li><?php echo $this->Html->link(_('Site-Routes'),array('controller' => 'routes', 'action' => 'index','manager' => true,'plugin' => 'siteconfig')); ?></li>
		<li><?php echo $this->Html->link(_('Site-Settings'),array('controller' => 'settings', 'action' => 'index','manager' => true,'plugin' => 'siteconfig')); ?></li>
	</ul>
	<p>More to come!</p>
	<p>More Information on <?php echo $this->Html->link('Github','https://github.com/traedamatic/CakePHP2.1-App-Template-',array('target' => '_blank')); ?></p>
	<p>Have fun with this template and cakephp!</p>
</div>