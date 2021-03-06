<?php echo $this->element('adminactions'); ?>
<div class="articles index">
	<h3><?php __('Artikelen');?></h3>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('Gebruikersnaam', 'user_id');?></th>
			<th><?php echo $this->Paginator->sort('Editie', 'edition_id');?></th>
			<th><?php echo $this->Paginator->sort('Titel', 'title');?></th>
			<th><?php echo $this->Paginator->sort('Datum toegevoegd', 'created');?></th>
			<th><?php echo $this->Paginator->sort('Datum bewerkt', 'modified');?></th>
			<th class="actions"><?php __('Wat wilt u doen?');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($articles as $article):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>

		<td>
			<?php echo $this->Html->link($article['User']['name'], array('controller' => 'users', 'action' => 'view', $article['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($article['Edition']['name'], array('controller' => 'editions', 'action' => 'view', $article['Edition']['id'])); ?>
		</td>
		<td><?php echo $article['Article']['title']; ?>&nbsp;</td>
		<td><?php echo $article['Article']['created']; ?>&nbsp;</td>
		<td><?php echo $article['Article']['modified']; ?>&nbsp;</td>
		<td class="actions">

			<?php echo $this->Html->link(__('Bewerken', 'Edit', true), array('action' => 'edit', $article['Article']['id'])); ?>
			<?php echo $this->Html->link(__('Verwijderen', 'Delete', true), array('action' => 'delete', $article['Article']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $article['Article']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>