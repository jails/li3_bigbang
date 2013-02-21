<ul class="nav nav-list">
	<li><a class="test-all" href="<?=$baseUrl; ?>test/all">run all tests</a></li>
	<li class="nav-header">Libraries</li>
<?php foreach ($libraries as $lib): ?>
	<li>
		<a class="menu-folder" href="<?php echo $baseUrl ?>test/?library=<?php echo $lib; ?>">
			<?php if($lib == $library): ?>
				<i class="icon-folder-open"></i>
			<?php else: ?>
				<i class="icon-folder-close"></i>
			<?php endif; ?>
			<?php echo $lib; ?>
		</a>
	</li>
<?php endforeach; ?>
</ul>
