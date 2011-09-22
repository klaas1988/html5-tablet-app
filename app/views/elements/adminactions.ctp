<div class="actions">
	<h3><?php __('Wat wilt u doen?'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Nieuw artikel', true), array('controller' => 'articles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Artikelen', true), array('controller' => 'articles', 'action' => 'index')); ?> </li><br />

		<li><?php echo $this->Html->link(__('Nieuwe editie', true), array('controller' => 'editions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Edities', true), array('controller' => 'editions', 'action' => 'index')); ?> </li><br />

		<li><?php echo $this->Html->link(__('Nieuwe auteur', true), array('controller' => 'authors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Auteurs', true), array('controller' => 'authors', 'action' => 'index')); ?> </li><br />

		<li><?php echo $this->Html->link(__('Nieuwe tag', true), array('controller' => 'tags', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Tags', true), array('controller' => 'tags', 'action' => 'index')); ?> </li><br />

		<li><?php echo $this->Html->link(__('Nieuw boek', true), array('controller' => 'books', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Boeken', true), array('controller' => 'books', 'action' => 'index')); ?> </li><br />

		<li><?php echo $this->Html->link(__('Nieuwe foto', true), array('controller' => 'photos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Foto\'s', true), array('controller' => 'photos', 'action' => 'index')); ?> </li><br />

		<li><?php echo $this->Html->link(__('Nieuwe gebruiker', true), array('controller' => 'users', 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Gebruikers', true), array('controller' => 'users', 'action' => 'index')); ?></li>
	</ul>
</div>