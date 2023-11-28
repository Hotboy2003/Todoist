<?php
/**
 * @var array $todos
 * @var bool $isHistory
 * @var array $errors
 * @var int|null $truncateTodo
 */
?>

<main>
<!--	если массив содержит ошибки, то вывести их-->
	<?php if (!empty($errors)): ?>
		<div class="alert danger">
			<?= implode('<br>', $errors) ?>
		</div>
	<?php endif; ?>

	<?php if (empty($todos)): ?>
		<p>Nothing todo here</p>
	<?php endif; ?>
	<?php foreach ($todos as $todo): ?>
		<?= view('components/todo', ['todo' => $todo, 'isHistory' => $isHistory, 'truncateTodo' => $truncateTodo]); ?>
	<?php endforeach; ?>

	<?php if (!$isHistory): ?>
		<form action="/" method="post" class="add-todo">
			<input type="text" name='title' required placeholder="What to do?">
			<button type="submit">Save</button>
		</form>
	<?php endif;?>
</main>