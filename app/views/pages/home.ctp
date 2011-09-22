<div class="header">Academische Boekengids</div>

<?php $editions_articles = $this->requestAction('articles/index'); ?>

<div id="featured">
        <div id="featured_item">
            <div id="featured_img">
            	<?php $edition_cover = $this->requestAction('photos/view/'.$editions_articles[0][0]['Edition']['photo_id']);echo $this->Html->image('images/original/'.$edition_cover['Photo']['name'], array('alt' => $edition_cover['Photo']['name'], 'width' => '163', 'height' => '235')); ?>
            </div>
            <ul id="featured_list">
            	<li>
                	Academische boekengids <?php echo $editions_articles[0][0]['Edition']['name'] ?>
				</li>
<?php foreach($editions_articles[0] as $article): ?>
                <li>
                    <?php echo $this->Html->link($article['Article']['title'], array('controller' => 'articles', 'action' => 'view', $article['Article']['id'])); ?>
                </li>
<?php endforeach; ?>
                <li>	
                    <?php echo $this->Html->link(__('Bekijk deze uitgave', true), array('controller' => 'editions', 'action' => 'view', $article['Edition']['id']), array('class' => 'button')); ?>
                    <?php echo $this->Html->link(__('Zoeken', true), array('controller' => 'pages', 'action' => 'display', 'search'), array('class' => 'button')); ?>
                    <?php echo $this->Html->link(__('Archief', true), array('controller' => 'pages', 'action' => 'display', 'archive', 'article_id:15'), array('class' => 'button')); ?>
                </li>
            </ul>
        </div>
        <div class="header">Voorgaande <?php echo count($editions_articles) - 1; ?> uitgaven</div>
    </div>
    
	<div id="edition_overview_wrapper" class="iscroll">
		<ul id="edition_overview">
    <?php $eai = 0;foreach($editions_articles as $articles): ?>
        <?php if($eai != 0): ?>
                <li>
                    <div class="list_img"><?php $edition_cover = $this->requestAction('photos/view/'.$articles[0]['Edition']['photo_id']);echo $this->Html->image('images/original/'.$edition_cover['Photo']['name'], array('alt' => $edition_cover['Photo']['name'], 'width' => '163', 'height' => '235')); ?></div>
                    <ul id="edition_overview_tekst">
            <?php foreach($articles as $article): ?>
                        <li>
                            <?php echo $this->Html->link($article['Article']['title'], array('controller' => 'articles', 'action' => 'view', $article['Article']['id'])); ?>
                        </li>
            <?php endforeach; ?>
                    </ul>
                        <div class="edition_overview_bekijk">
                            <?php echo $this->Html->link(__('Bekijk uitgave', true), array('controller' => 'editions', 'action' => 'view', $articles[0]['Edition']['id']), array('class' => 'button')); ?>
                        </div>
                </li>
        <?php endif;$eai++; ?>
    <?php endforeach; ?>
		</ul>
	</div>
