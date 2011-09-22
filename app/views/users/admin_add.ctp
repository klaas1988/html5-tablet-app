<?php echo $this->element('adminactions'); ?>
<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php __('Een nieuwe account maken'); ?></legend>
	<?php
		echo $this->Form->input('name', array('label' => "Naam"));
		echo $this->Form->input('username', array('label' => "Gebruikersnaam", 'empty' => true, 'autocomplete' => 'off'));
		echo $this->Form->input('password', array('label' => "Wachtwoord", 'empty' => true, 'autocomplete' => 'off'));
		echo $this->Form->input('email', array('label' => "Email", 'empty' => true, 'autocomplete' => 'off'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Opslaan', true));?>
</div>
