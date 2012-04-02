<div id="users-view-login" class="" >
	<h1> <?php echo Configure::read('Website.title') ?>Anmelden</h1>
	<p> Bitte melden Sie sich mit Ihrem Benutzername und Password an: </p>

	<?php //array('controller' => 'users', 'action' => 'login')
	  echo $this->Form->create('User',array('action' => 'login', "model" => false));
	  echo $this->Form->input('username',array('label' => 'Benutzername', 'type' => 'text'));
	  echo $this->Form->input('password',array('type' => 'password','label' => 'Passwort'));
	  echo $this->Form->button('Login',array('type' => 'submit'));
	  echo $this->Form->end();
	?>
</div>