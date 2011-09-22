<div class="login">
	<?php echo $this->Form->create('User'); ?>
	
	<fieldset>
		<legend>Log in</legend>
		
		<?php
			echo $this->Form->input('User.username', array('label' => 'Gebruikersnaam'));
			echo $this->Form->input('User.password', array('label' => 'Wachtwoord'));
		?>
	</fieldset>
	<?php echo $this->Form->end('Log in'); ?>
</div>