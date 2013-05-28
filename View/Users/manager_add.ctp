<div id="users-view-manager-add">
	<h1> <?php echo __("Add new User"); ?></h1>
	<?php 
		echo $this->Form->create('User');
		echo $this->Form->input('username');
		echo $this->Form->input('password',array('type' => 'password'));
		echo $this->Form->input('retypepassword',array('type' => 'password','label' => "Retype Password"));
		echo $this->Form->button('Benutzer anlegen',array('class' => 'button dark'));
		echo $this->Form->end();
	?>

</div><!-- /users-view-manager-add -->