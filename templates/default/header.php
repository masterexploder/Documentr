<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
<head>
	<!-- Copyright 2009 eMeter Corporation. All Rights Reserved. -->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?php echo $config['name']; ?><?php if (isset($name)) { echo ' - ' . $name; } ?></title>

	<link href="styles.css" rel="stylesheet" media="screen" type="text/css" />	
	
	<script type="text/javascript" src="scripts/mootools-1.2.4-core-yc.js"></script>
	<script type="text/javascript" src="scripts/mootools-1.2.4.4-more.js"></script>
	<script type="text/javascript">
		window.addEvent('domready', function () 
		{
			$('guide-index').position({ relativeTo: 'guide-index-link', position: 'upperRight', edge: 'upperRight' });
			
			$('guide-index-open').addEvent('click', function () { $('guide-index').show(); });
			$('guide-index-close').addEvent('click', function () { $('guide-index').hide(); });
		});
	</script>
</head>

<body>

<div id="nonFooter">
<div class="header-wrap">
	<div class="header">
		<div class="guide-index" id="guide-index" style="display: none">
			<h2><a href="#" id="guide-index-close">Guides Index</a></h2>
			<div class="left-col">
			<?php
				$numDisplayed 	= 0;
				$splitNum		= abs(Documentr::$numGuides / 2);
				$haveSplit		= false;
				
				foreach ($index as $section => $guide):
			?>
				<h3><?php echo $section ?></h3>
				<?php foreach ($guide as $guideName): ?>
					<?php if ($guides[$guideName]['exists']): ?>
						<a href="<?php echo str_replace('.md', '.html', $guides[$guideName]['source_file']); ?>"><?php echo $guideName; ?></a>
					<?php else: ?>
						<?php echo $guideName; ?>
					<?php endif; ?><br />
				<?php $numDisplayed++; ?>
				<?php endforeach; ?>
				<?php if ($numDisplayed >= $splitNum && !$haveSplit): ?></div><div class="right-col"><?php $haveSplit = true; endif; ?>
			<?php endforeach; ?>
			
			</div>
			<div class="clearfix"></div>
		</div>
		
		<h1><?php echo $config['name']; ?></h1>
	
		<ul class="nav">
			<li><a href="index.html">Home</a></li>
			<li class="index" id="guide-index-link">
				<a href="#" id="guide-index-open">Guides Index</a>
			</li>
		</ul>
		
		<div class="clearfix"></div>
	</div>
</div>