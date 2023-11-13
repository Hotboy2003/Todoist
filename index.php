<?php

function main(array $arguments): void
{
	array_shift($arguments); //убираем первый элемент массива (путь файла)

	$command = array_shift($arguments); //смотрим команду

	switch ($command)
	{
		case "list":
			listCommand($arguments);
			break;
		case "add":
			addCommand($arguments);
			break;
		case "complete":
			completeCommand($arguments);
			break;
		case "remove":
		case "rm":
			removeCommand($arguments);
			break;
		default:
			echo "Unknown command";
			exit(1);
	}
}

function addCommand(array $arguments)
{
	$title = array_shift($arguments);

	// создаем массив todo
	$todo = [
		'id' => uniqid('', true), //псевдоуникальный id
		'title' => $title,
		'completed' => false,
	];

	$fileName = date('Y-m-d') . '.txt'; // сохраняем имя файла с текущей датой
	$filePath = __DIR__ . '/data/' . $fileName; // запоминаем полный путь до файла с делами

	// если файл существует
	if (file_exists($filePath))
	{
		$content = file_get_contents($filePath); // сохраняем сериализованный контент из файла
		$todos = unserialize($content, ['allowed_classes' => false,]); // десериализуем, allowed_classes - для безопасности
		$todos[] = $todo; // добавляем новую задачу
		file_put_contents($filePath, serialize($todos)); // кладем в файл
	} else
	{
		$todos = [$todo]; // добавялем новую задачу в массив
		file_put_contents($filePath, serialize($todos));
	}
}

function listCommand(array $arguments)
{
	$fileName = date('Y-m-d') . '.txt'; // сохраняем имя файла с текущей датой
	$filePath = __DIR__ . '/data/' . $fileName; // запоминаем полный путь до файла с делами

	// если файл не существует
	if (!file_exists($filePath))
	{
		echo "Nothing to do here";
		return;
	}

	$content = file_get_contents($filePath); // сохраняем сериализованный контент из файла
	$todos = unserialize($content, ['allowed_classes' => false,]); // десериализуем, allowed_classes - для безопасности

	// если массив пустой
	if (empty($todos))
	{
		echo "Nothing to do here";
		return;
	}

	// вывод названий дел
	foreach ($todos as $index => $todo)
	{
		echo sprintf("%s. [%s] %s \n",
			($index + 1),
			$todo['completed'] ? 'x' : ' ',
			$todo['title']);
	}
}

function removeCommand(array $arguments)
{

}

function completeCommand(array $arguments)
{

}





main($argv);