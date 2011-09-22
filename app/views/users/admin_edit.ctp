<?php echo $this->element('adminactions'); ?>
<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php __('Gebruiker bewerken'); ?></legend>
	<?php
		echo $this->Form->input('name', array('label' => "Naam"));
		echo $this->Form->input('username', array('label' => "Gebruikersnaam"));
		echo $this->Form->input('email', array('label' => "Email"));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Opslaan', true));?>
</div>
