<?php echo $this->element('adminactions'); ?>
<div class="editions form">
<?php echo $this->Form->create('Edition');?>
	<fieldset>
		<legend><?php __('Add Edition'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('date');
		echo $this->Form->input('photo_id', array('empty' => true));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
