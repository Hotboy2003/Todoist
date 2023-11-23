<?php
/**
 * @var array $todo
 * @var bool $isHistory
 */
?>

<article class="todo">
	<label>
		<!--					тернарный оператор-->
		<input
			type="checkbox"
			<?= ($todo['completed']) ? 'checked' : ''; ?>
			<?= ($isHistory) ? 'disabled' : ''; ?>
		>
<!--		заменяем символы, которые могут быть опасными на безопасные (те же самые)-->
		<?= safe($todo['title']); ?>
	</label>
</article>