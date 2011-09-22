<div id="articles">
<?php foreach($articles as $article): ?>
	<h2><?php echo $html->link($article['Article']['title'], array('controller' => 'articles', 'action' => 'view', $article['Article']['id'])); ?></h2>
	<p>
		<?php //echo $html->link($html->image('images/small/'.$article['Photo'][0]['name'], array('width' => 70, 'height' => 70)), array('controller' => 'articles', 'action' => 'view', $article['Article']['id']), array('escape' => false)); ?>
		<?php echo $article['Article']['summary']; ?> <?php echo $html->link(__('Lees verder...', true), array('controller' => 'articles', 'action' => 'view', $article['Article']['id'])); ?>
		<br /><span><?php __('Geplaatst op'); ?> <?php echo $time->format('d-m-Y, H:i:s', $article['Article']['created']); ?></span>
	</p>
<?php endforeach; ?>
</div>
