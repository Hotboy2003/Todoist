
<?php
/**
 * @var string $title
 * @var string $content
 * @var array $bottomMenu
 */
?>


<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="style.css">
	<!--			запись, аналогичная echo-->
	<title><?= $title; ?></title>
</head>
<body>
<section class="content">
	<header>
		<a class="icon" href="/">📝</a>
		<!--			запись, аналогичная echo-->
		<h1><?= $title; ?></h1>
	</header>

	<?= $content; ?>


	<footer>
		<div>
			&copy; <?= date('Y'); ?> Todoist by Bitrix University
		</div>
		<?= view('components/menu', ['menuItems' => $bottomMenu,]) ?>
	</footer>
</section>
</body>
</html>