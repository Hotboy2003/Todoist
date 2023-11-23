<?php
/**
 * @var string $title
 * @var array $report
 */
?>
<main>
	<?php foreach ($report as $line): ?>
		<p><?= $line ?></p>
	<?php endforeach; ?>
</main>