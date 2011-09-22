<div class="header">
    <a href="#">
	    <div class="navigatie_terug_image"></div>
	    <div class="navigatie_terug">Terug</div>
    </a>
	Artikel
</div>
<div class="article_container">
	<h1 class="article"><?php echo $article['Article']['title']; ?></h1>

	<div id="article_content" class="iscroll">
		<ul>
			<li class="article_column">
				<p class="article_intro_text">
					<?php echo $article['Article']['summary']; ?>
				</p>
				<?php echo $article['Article']['content']; ?>
			</li>
		</ul>
	<div>
		
</div>