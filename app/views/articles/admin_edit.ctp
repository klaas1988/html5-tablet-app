<?php echo $this->element('adminactions'); ?>
<div class="articles form">
<?php echo $this->Form->create('Article');?>
	<fieldset>
		<legend><?php __('Bewerk artikel'); ?></legend>
	<?php
		echo $this->Form->input('id', array('type' => 'hidden'));
		echo $this->Form->input('Article.edition_id', array('label' => "Editie"));
		echo $this->Form->input('Article.author_id', array('label' => "Auteur"));
		echo $this->Form->input('title', array('label' => 'Titel'));
		echo $this->Form->label('Article.summary', __('Samenvatting', true));
		echo $this->Form->textarea('Article.summary');
		echo $this->Form->input('content', array('label' => 'Artikel', 'class' => 'advanced', 'rows' => 30, 'cols' => 90));
		echo $this->Form->input('Tag');
		echo $this->Html->link(__('Nieuwe Tag', true), array('controller' => 'tags', 'action' => 'add'));
		echo $this->Form->input('Book');
		echo $this->Html->link(__('Nieuw Boek', true), array('controller' => 'books', 'action' => 'add'));
	?>
	</fieldset>
		<fieldset>
	<?php
		echo $this->Form->input('Image. .file', array('label' => __('Foto\'s', true).' ('.__('U kunt meerdere foto\'s tegelijk selecteren', true).')', 'type' => 'file', 'multiple' => 'multiple'));
	?>
		<?php if (isset($article['Photo'])): ?>
			<?php $i = 1; ?>
			<?php foreach($article['Photo'] as $photo): ?>
				<div class="media">
					<div class="photo_thumb">
						<img src="img/images/small/<?php echo $photo['name']; ?>" /><br />
					</div>
						<div class="photo_actions">
						<?php echo $this->Form->input('Photo.'.$i.'.id', array('value' => $photo['id'])); ?>
						<?php echo $this->Form->input('Photo.'.$i.'.name', array('value' => $photo['name'], 'type' => 'hidden')); ?>
						<?php echo $this->Form->input('Photo.'.$i.'.order_key', array('value' => $photo['order_key'], 'type' => 'hidden')); ?>
							<?php echo $this->Form->checkbox('Photo.'.$i.'.delete'); ?>
							<?php echo $this->Form->label('Photo.'.$i.'.delete', 'Verwijderen'); ?>
						<?php $i++; ?>
						<?php 
								if ($photo['order_key'] != $count)
									echo $html->link($html->image('icons/Down.png', array('alt' => 'Omlaag')), array('admin' => true, 'controller' => 'articles', 'action' => 'on_down', $photo['id'], $photo['order_key'], $article['Article']['id']), array('class' => 'unitExt', 'style' => 'margin-left: 4px;', 'title' => 'Deze foto omlaag verplaatsen', 'escape' => false));
							?>
							<?php 
								if ($photo['order_key'] != 1)
									echo $html->link($html->image('icons/Up.png', array('alt' => 'Omhoog')), array('admin' => true, 'controller' => 'articles', 'action' => 'on_up', $photo['id'], $photo['order_key'], $article['Article']['id']), array('class' => 'unitExt', 'style' => 'margin-left: 4px;', 'title' => 'Deze foto omhoog verplaatsen', 'escape' => false));
							?>
					</div>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
