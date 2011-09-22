<?php echo $this->element('adminactions'); ?>
<div class="articles form">
<?php echo $this->Form->create('Article');?>
	<fieldset>
		<legend><?php __('Nieuw Artikel'); ?></legend>
	<?php
		echo $this->Form->input('Article.user_id', array('type' => 'hidden', 'value' => $session->read('Auth.User.id')));
		echo $this->Form->input('Article.edition_id', array('label' => "Editie"));
		echo $this->Form->input('Article.author_id', array('label' => "Auteur"));
		echo $this->Form->input('Article.title', array('label' => __('Titel', true)));
		echo $this->Form->input('Article.summary', array('type' => 'textarea', 'label' => __('Samenvatting', true)));
		echo $this->Form->input('Article.content', array('rows' => 30, 'cols' => 90, 'class' => 'advanced', 'label' => __('Artikel', true)));
		echo $this->Form->input('Tag');
		echo $this->Html->link(__('Nieuwe Tag', true), array('controller' => 'tags', 'action' => 'add'));
		echo $this->Form->input('Book');
		echo $this->Html->link(__('Nieuw Boek', true), array('controller' => 'books', 'action' => 'add'));
	?>
	</fieldset>
	<fieldset>
		<legend><?php __('Foto\'s'); ?></legend>
	<?php
		echo $this->Form->input('Image. .file', array('label' => __('Foto\'s', true).' ('.__('U kunt meerdere foto\'s tegelijk selecteren', true).')', 'type' => 'file', 'multiple' => 'multiple'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
