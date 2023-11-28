<?php

// функция получения тудушек, возможно принимает время, если не принимает, то оно равно null
function getTodos(?int $time = null): array
{
	$connection = getDbConnection();

	$from = date('Y-m-d 00:00:00', $time);
	$to = date('Y-m-d 23:59:59', $time);
	// выбираем тудушки за сегодняшний день from - 00:00 to - 23:59:59
	$result = mysqli_query($connection, "
		SELECT * FROM todos
		WHERE created_at BETWEEN '{$from }' AND '{$to}'
		ORDER BY created_at
		LIMIT 100 
	");
	if (!$result)
	{
		throw new Exception(mysqli_error($connection));
	}

	$todos = [];

	while ($row = mysqli_fetch_assoc($result)) //возвращает ассоциативныый массив
	{
		$todos[] = [
			'id' => $row['id'],
			'title' => $row['title'],
			'completed' => ($row['completed'] === 'Y'),
			'created_at' => $row['created_at'],
			'updated_at' => $row['updated_at'] ? strtotime($row['updated_at']) : null,
			'completed_at' => $row['completed_at'] ? strtotime($row['completed_at']) : null,
		];
	}


	return $todos;
	// $filePath = getRepositoryPath($time);
	//
	// // если файл не существует
	// if (!file_exists($filePath))
	// {
	// 	return [];
	// }
	//
	// $content = file_get_contents($filePath); // сохраняем сериализованный контент из файла
	// $todos = unserialize($content, ['allowed_classes' => false,]); // десериализуем, allowed_classes - для безопасности
	//
	// return is_array($todos) ? $todos : []; // если массив, возвращаем массив, если нет - пустой массив
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

// function getRepositoryPath(?int $time): string
// {
// 	$time = $time ?? time(); // если переменная пустая, то ставим текущее значение времени, если нет - то оставляем как было
//
// 	$fileName = date('Y-m-d', $time) . '.txt'; // сохраняем имя файла с датой
//
// 	return ROOT . '/data/' . $fileName; // запоминаем полный путь до файла с делами
// }

function addTodo(array $todo): bool
{
	$connection = getDbConnection();

	$id = mysqli_real_escape_string($connection, $todo['id']);
	$title = mysqli_real_escape_string($connection, $todo['title']);


	$sql = "INSERT INTO todos (id, title) VALUES ('{$id}', '{$title}')";

	$result = mysqli_query($connection, $sql);
	if (!$result)
	{
		throw new Exception(mysqli_error($connection));
	}

	return true;

	// $todos = getTodos($time);
	// $todos[] = $todo; // добавляем новую задачу
	//
	// storeTodos($todos); // кладем в файл
}

//функция добавления тудушек в файл
// function storeTodos(array $todos, ?int $time = null): void
// {
// 	$filePath = getRepositoryPath($time);
// 	file_put_contents($filePath, serialize($todos)); // кладем в файл
// }