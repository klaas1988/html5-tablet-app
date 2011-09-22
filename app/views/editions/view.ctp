<div class="header">
	<a href="#"><div class="navigatie_terug_image"></div>
    <div class="navigatie_terug">Terug</div></a>
	Academische boekengids <?php echo $edition['Edition']['name']; ?>
</div>
<div id="editie" class="iscroll">
<ul>
	<?php
	foreach ($edition['Article'] as $article)
	{
	?>
		<li>
	    	<h1><?php echo $this->Html->link($article['title'], array('controller' => 'articles', 'action' => 'view', $article['id'])); ?></h1>
	        <h2><?php echo $this->Html->link($article['summary'], array('controller' => 'articles', 'action' => 'view', $article['id'])); ?></h2>
	        <h3>Door KH<?php //echo $article['Author']['name']; ?> - <?php echo $time->format('d-m-Y, H:i:s', $article['created']); ?></h3>
		</li>
	<?php 
	} 
	?>
</ul>
</div>
<div class="header">Andere uitgaven</div>
<div id="uitgave_slider" class="iscroll">
    <ul style="width:3035px;">
	    <li>
	    <img src="img/preview.png" alt="" />
	    </li>
	    <li>
	    <img src="img/preview.png" alt="" />
	    </li>
	    <li>
	    <img src="img/preview.png" alt="" />
	    </li>
	    <li>
	    <img src="img/preview.png" alt="" />
	    </li>
	    <li>
	    <img src="img/preview.png" alt="" />
	    </li>
	    <li>
	    <img src="img/preview.png" alt="" />
	    </li>
	    <li>
	    <img src="img/preview.png" alt="" />
	    </li>
	    <li>
	    <img src="img/preview.png" alt="" />
	    </li>
	    <li>
	    <img src="img/preview.png" alt="" />
	    </li>
	    <li>
	    <img src="img/preview.png" alt="" />
	    </li>
	    <li>
	    <img src="img/preview.png" alt="" />
	    </li>
	    <li>
	    <img src="img/preview.png" alt="" />
	    </li>
	    <li>
	    <img src="img/preview.png" alt="" />
	    </li>
	    <li>
	    <img src="img/preview.png" alt="" />
	    </li>
	    <li>
	    <img src="img/preview.png" alt="" />
	    </li>
	    <li>
	    <img src="img/preview.png" alt="" />
	    </li>
    </ul>
</div>