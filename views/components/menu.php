<?php
/**
 * @var array $menuItems
 */

$currentPage = $_SERVER['REQUEST_URI'];
?>

<nav>
	<?php foreach ($menuItems as $item): ?>
		<a
			href="<?= $item['url']; ?>"
	   		class="<?= ($currentPage === $item['url']) ? 'is-active' : '' ?>"> <?= $item['text']; ?>
		</a>
	<?php endforeach; ?>
</nav>