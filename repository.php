<?php

// функция получения тудушек, возможно принимает время, если не принимает, то оно равно null
function getTodos(?int $time = null): array
{
	$filePath = getRepositoryPath($time);

	// если файл не существует
	if (!file_exists($filePath))
	{
		return [];
	}

	$content = file_get_contents($filePath); // сохраняем сериализованный контент из файла
	$todos = unserialize($content, ['allowed_classes' => false,]); // десериализуем, allowed_classes - для безопасности

	return is_array($todos) ? $todos : []; // если массив, возвращаем массив, если нет - пустой массив
}

function getTodosOrFail(?int $time = null): array
{
	$todos = getTodos($time);
	// если массив пустой
	if (empty($todos))
	{
		echo "Nothing to do here" . PHP_EOL;
		exit();
	}

	return $todos;
}

function getRepositoryPath(?int $time): string
{
	$time = $time ?? time(); // если переменная пустая, то ставим текущее значение времени, если нет - то оставляем как было

	$fileName = date('Y-m-d', $time) . '.txt'; // сохраняем имя файла с датой

	return ROOT . '/data/' . $fileName; // запоминаем полный путь до файла с делами
}

function addTodo(array $todo, ?int $time=null)
{
	$todos = getTodos($time);
	$todos[] = $todo; // добавляем новую задачу

	storeTodos($todos); // кладем в файл
}

//функция добавления тудушек в файл
function storeTodos(array $todos, ?int $time = null): void
{
	$filePath = getRepositoryPath($time);
	file_put_contents($filePath, serialize($todos)); // кладем в файл
}