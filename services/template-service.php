<?php

function view(string $path, array $variables = []): string
{
	// проверка на то что путь содержит только эти символы
	if (!preg_match('/^[0-9A-Za-z\/_-]+$/', $path))
	{
		throw new Exception('Invalid template path');
	}

	$absolutePath = ROOT . "/views/$path.php";

	if (!file_exists($absolutePath))
	{
		throw new Exception('Template not found');
	}

	// сохраняем элементы массива в переменные
	extract($variables);

	// начинаем буферизацию
	ob_start();
	require $absolutePath; // получаем строку

	return ob_get_clean();
}

function safe(string $value): string
{
	return htmlspecialchars($value, ENT_QUOTES);
}