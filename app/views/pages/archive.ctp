<div class="header">
    <a href="#"><div class="navigatie_terug_image"></div>
    <div class="navigatie_terug">Terug</div></a>
    Archief
    <div class="navigatie">
        <a class="pop" href="#popover"><div class="navigatie_btn"><p> Zoeken</p></div>	</a>		
        <a class="pop" href="#popover3"><div class="navigatie_btn"><p>Filteren</p></div></a>
        <a href="pages/archive_editions"><div class="navigatie_switch_left">Uitgaven</div></a>
        <a class="current" href="pages/archive/article_id:15"><div class="navigatie_switch_right">Artikelen</div></a>
    </div>

	<div id="popover">
        <h1>Zoeken</h1>
        <div id="block">
        	<div id="searchblock">
        		<form>  
                		<input type="text" id="search">
            	</form>
        	</div>
        
        	<h2>Artikelen</h2>
        	<ul>
        	<li>
        		<a href="#">Lorem ipsum 3</a>
        	</li>
        	<li>
        		<a href="#">Lorem ipsum 4</a>
        	</li>
        	</ul>
       		 	<h2>Auteurs</h2>
       		 	<ul>
       		 		<li>
       		 			Lorem ipsum 3
       		 		</li>
       		 		<li>
       		 			Lorem ipsum 4
       		 		</li>
       		 		<li>
       		 			Klaas
       		 		</li>
       		 	</ul>
        		<h2>Inhoud</h2>
        		<ul>
        			<li>
        				Lorem ipsum 3
        			</li>
        			<li class="last">
        				Lorem ipsum 4
        			</li>
        		</ul>
        	</div>
        	<p>U kunt zoeken op titel, inhoud, auteur en tags</p>
        </div>
        
        <div id="popover3">
	        <h1>Sorteren</h1>
	        <div id="block3">
		        <ul>
			        <li><a href="#popover2">Selecteren op categorie</a></li>
			        <li><a href="#">Selecteren op datum</a></li>
			        <li><a href="#">Selecteren op populaire auteurs</a></li>
		        </ul>
	        </div>
        </div>
  
        <div id="popover2">
        	<h1>Jaar</h1>
        	<div id="block2">
	            <div id="content">
		            <ul>
		            	<li><img src="img/huidig.png" /><a href="#">2011</a><img class="arrow"><img class="nummer"></li><li><a href="#">2010</a><img class="arrow"><img class="nummer"></li>
			            <li>2009<img class="arrow"><img class="nummer"></li><li>2008<img class="arrow"><img class="nummer"></li><li>2007<img class="arrow"><img class="nummer"></li>
			            <li>2006<img class="arrow"><img class="nummer"></li><li>2005<img class="arrow"><img class="nummer"></li><li>2004<img class="arrow"><img class="nummer"></li>
			            <li>2003<img class="arrow"><img class="nummer"></li>
		            </ul>
	            </div>
        	</div>
        </div>

	

        <div id="popover4">
        	<h1>Auteurs</h1>
            
        	<div id="block2">
	            <div id="content">
		            <ul>
			            <li><img src="img/huidig.png" /><a href="#">Frans van lunteren</a><img class="arrow"><img class="nummer"></li><li><a href="#">Pieter van der Kruit</a><img class="arrow"><img class="nummer"></li>
			            <li>Hans Bennis<img class="arrow"><img class="nummer"></li><li>Bart Thomma<img class="arrow"><img class="nummer"></li><li>Jaco Zuijderduijn<img class="arrow"><img class="nummer"></li>
			            <li>Jaap Goudsmit<img class="arrow"><img class="nummer"></li><li>Sijbelt Noorda<img class="arrow"><img class="nummer"></li><li>Gerrit Burgers<img class="arrow"><img class="nummer"></li>
			            <li>Maaike Kofferman<img class="arrow"><img class="nummer"></li>
		            </ul>
	            </div>
        	</div>

        </div>
        
        <div id="popover5">
        	<h1>Categorie</h1>
        	<div id="block2">
	            <div id="content">
		            <ul>
			            <li><img src="img/huidig.png" /><a href="#">Techniek</a><img class="arrow"><img class="nummer"></li><li><a href="#">Psychologie</a><img class="arrow"><img class="nummer"></li>
			            <li>Geneeskunde<img class="arrow"><img class="nummer"></li><li>Archeologie<img class="arrow"><img class="nummer"></li><li>Biologie<img class="arrow"><img class="nummer"></li>
			            <li>Scheikunde<img class="arrow"><img class="nummer"></li><li>Theologie<img class="arrow"><img class="nummer"></li><li>Natuurkunde<img class="arrow"><img class="nummer"></li>
			            <li>Informatica<img class="arrow"><img class="nummer"></li>
		            </ul>
           		</div>
        	</div>
        </div>
</div>
        
    <div id="archief">
    
     <div class="archief_kop">Artikelen</div>
    
<?php $tags_articles = $this->requestAction('articles/index/tags'); ?>
        <div id="archive_list" class="iscroll">
	       	<ul>
<?php foreach($tags_articles as $articles): ?>
				<li class="archief_titel"><?php echo ucfirst($articles['Tag']['name']); ?></li>
	<?php foreach($articles['Article'] as $article): ?>
	        	<?php $class_active = $this->params['named']['article_id'] == $article['id'] ? 'archief_active' : ''; ?>
                <li class="<?php echo $class_active; ?>">
	        	    <?php echo $this->Html->link($article['title'], array('controller' => 'pages', 'action' => 'display', 'archive', 'article_id:'.$article['id']), array('class' => $class_active)); ?>
	       		</li>
	<?php endforeach; ?>
<?php endforeach; ?>
	    	</ul>
	    </div>
	</div>

<?php $article = $this->requestAction('articles/view/'.$this->params['named']['article_id']); ?>
	<div id="zoom">
		<div class="zoom_header"><?php echo $article['Article']['title']; ?></div>
			<div id="zoom_scroll" class="iscroll">
				<ul> 
            		<li>                        
                        <p><?php echo $article['Article']['summary']; ?></p>
					</li>
					<li>
						<?php echo $this->Html->link(__('Lees het gehele artikel', true), array('controller' => 'articles', 'action' => 'view', $article['Article']['id']), array('class' => 'button_white')); ?>
					</li>
                    <li>
                    	<h1>Behandelde boeken</h1>
					</li>
					<li class="list_white_top">
						<h2>Duel at dawn. Heroes, martyrs, and the rise of modern mathematics</h2>
			            <h3>Door Amir Alexander.</h3>
						<h3>Harvard University Press.</h3>
						<h3>Londen/Cambridge, Mass. 2010.</h3>
						<h3>307 pagina's.</h3>
	            		<h2>32.25 &euro;</h2>
					</li>
					<li class="list_white">
	        			<h2>How to find a habitable planet</h2>
	       		   		<h3>Door Amir Alexander.</h3>
						<h3>Harvard University Press.</h3>
						<h3>Londen/Cambridge, Mass. 2010.</h3>
						<h3>307 pagina's.</h3>
	        	   		<h2>29.95 &euro;</h2>
					</li>
					<li class="list_white">
	        			<h2>Chams Eddine Zaougui legt uit waarom</h2>
	                    <h3>Door Chams Eddine Zaougui</h3>
					</li>
					<li class="list_white">
	        			<h2>Gedicht van Nachoem M. Wijnberg</h2>
	                    <h3>Door Frans van Lunteren</h3>
					</li>
					<li class="list_white">
	        			<h2>Bepaalt China de toekomst van Afrika?</h2>
	                    <h3>Door Bart Thomma</h3>
					</li>
					<li class="list_white_bottom">
	        			<h2>Hans Bennis verklaart het gebrek aan ch...</h2>
	                    <h3>Door Jacco Zuijderduijn</h3>
					</li>

				</ul>
			</div>
	</div>
</div>
