<?php
/**
 * @var array $errors
 */
?>

<main>
	<!--	если массив содержит ошибки, то вывести их-->
	<?php if (!empty($errors)): ?>
		<div class="alert danger">
			<?= implode('<br>', $errors) ?>
		</div>
	<?php endif; ?>

	<form action="/login.php" method="post" class="add-todo">
		<input type="text" name='login' required placeholder="Login">
		<input type="text" name='password' required placeholder="Password">
		<button type="submit">Sign in</button>
	</form>
</main>