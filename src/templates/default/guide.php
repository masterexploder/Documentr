<?php include 'header.php'; ?>

<div class="intro-wrap">
	<div class="intro">
		<div class="disclaimer">
			<div class="toc">
				<h3>Chapters</h3>
				<ol>
					<?php foreach ($toc as $chapter => $topics): ?>
					<li>
						<a href="#<?php echo strtolower(str_replace(' ', '-', preg_replace('/[^a-zA-Z0-9 -]/', '', $chapter)));  ?>"><?php echo $chapter; ?></a>
						<?php if (count($topics) > 0): ?>
						<ul>
							<?php foreach ($topics as $topic): ?>
							<li><a href="#<?php echo strtolower(str_replace(' ', '-', preg_replace('/[^a-zA-Z0-9 -]/', '', $topic)));  ?>"><?php echo $topic; ?></a></li>
							<?php endforeach; ?>
						</ul>
						<?php endif; ?>
					</li>
					<?php endforeach; ?>
				</ol>
			</div>
		</div>
		<h2><?php echo $name; ?></h2>
		<?php echo $header; ?>
	</div>
</div>

<div class="body">
	<div class="content">
		<?php echo $body ?>
	</div>
</div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>