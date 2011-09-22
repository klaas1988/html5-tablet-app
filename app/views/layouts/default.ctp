<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Language" content="nl" />
		<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name = "viewport" content = "initial-scale = 1, user-scalable = no" />
		<link rel="apple-touch-icon" href="img/apple-touch-icon.png" />
		<base href="<?php echo Router::url("/", true); ?>" />
		<?php echo $this->Html->meta('apple-touch-icon.png', 'img/apple-touch-icon.png', array('type' => 'icon'));?>
		<title><?php echo $title_for_layout; ?> - Academische Boekengids</title>
		<?php echo $this->Html->css('style'); ?>
		<?php echo $this->Html->script('lib/jquery/jquery-1.6.1.min'); ?>
        <?php echo $this->Html->script('lib/jquery/jquery-ui-1.8.13.custom.min'); ?>
		<?php echo $this->Html->script('iscroll-lite-min'); ?>
		<?php echo $this->Html->script('jquery.doubletap'); ?>
        <?php echo $this->Html->script('jquery.custom'); ?>
	</head>
    
	<body>
	<!-- HUIDIGE PAGINA -->
	<div id="container">
		<?php echo $content_for_layout; ?>
	</div>

	<!-- VERVOLG PAGINA -->
	<div id="container_right">
		
	</div>

    <!-- MENU -->
	<div id="menu">
			<ul>
				<?php $home_active = $this->params['url']['url'] == '/' ? 'active' : ''; ?>
                <li class="<?php echo $home_active; ?>">
	        	    <?php echo $this->Html->tag('div', '', array('class' => 'home')).$this->Html->link('Home', "#"); ?>
				</li>
					<?php $archive_active = $this->params['url']['url'] == 'pages/archive/article_id:15' ? 'active' : ''; ?>
                <li class="<?php echo $archive_active; ?>">
	        	    <?php echo $this->Html->tag('div', '', array('class' => 'archief')).$this->Html->link('Archief', array('controller' => 'pages', 'action' => 'display', 'archive', 'article_id:15')); ?>
				</li>
				<?php $search_active = $this->params['url']['url'] == 'pages/search' ? 'active' : ''; ?>
                <li class="<?php echo $search_active; ?>">
	        	    <?php echo $this->Html->tag('div', '', array('class' => 'zoeken')).$this->Html->link('Zoeken', array('controller' => 'pages', 'action' => 'display', 'search')); ?>
				</li>
			</ul>
		</div>
</body>
</html>