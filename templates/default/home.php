<?php include 'header.php'; ?>

<div class="intro-wrap">
	<div class="intro">
		<div class="disclaimer">
			<div class="ticket">
				Guides marked with this icon are currently works in progress.  They may contain incomplete (if any) information and even errors.  While they may contain information
				useful to you, it is important to know they could be inaccurate and will change.
			</div>
		</div>
		<h2><?php echo $config['name']; ?> guides</h2>
		<p><?php echo $config['introduction']; ?></p>
	</div>
</div>

<div class="body">
	<?php foreach ($index as $section => $guide): ?>
	<div class="section">
		<h3><?php echo $section ?></h3>
		
		<?php foreach ($guide as $guideName): ?>
		<?php $guideInfo = $guides[$guideName]; ?>
		<dl>
			<?php if ($guideInfo['exists']): ?>
			<dt><a href="<?php echo str_replace('.md', '.html', $guideInfo['source_file']); ?>"><?php echo $guideName; ?></a></dt>
			<?php else: ?>
			<dt><?php echo $guideName; ?></dt>
			<?php endif; ?>
			
			<?php if (isset($guideInfo['wip']) && $guideInfo['wip'] == true): ?>
			<dd class="ticket"><?php echo $guideInfo['description']; ?></dd>
			<?php else: ?>
			<dd><?php echo $guideInfo['description']; ?></dd>	
			<?php endif; ?>
		</dl>
		<?php endforeach; ?>
	</div>
	<?php endforeach; ?>
	
</div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>