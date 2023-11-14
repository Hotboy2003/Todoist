<?php

function reportCommand(array $arguments = [])
{
	$allTodos = prepareReportData();

	$totalDays = count($allTodos); // всего дней
	// всего задач
	$totalTasksCount = array_reduce($allTodos, static function($prev, $todos) {
		return $prev + count($todos);
	}, 0);
	// всего выполненных задач
	$totalCompletedTasksCount = array_reduce($allTodos, static function($prev, $todos) {
		$completed = array_filter($todos, fn($todo) => $todo['completed']);
		return $prev + count($completed);
	}, 0);
	// количество задач в день
	$dailyTasksCount = array_map(function($todos) {
		return count($todos);
	}, $allTodos);

	$minTasks = min($dailyTasksCount); // минимальное количество задач
	$maxTasks = max($dailyTasksCount); // максимальное количество задач

	$averageTasksCount = 0;
	$averageCompletedTasksCount = 0;

	if ($totalDays > 0)
	{
		$averageTasksCount = floor($totalTasksCount / $totalDays); // среднее количество задач в день
		$averageCompletedTasksCount = floor($totalCompletedTasksCount / $totalDays); // среднее количество выполненных задач в день
	}

	$report = [
		"Total days: $totalDays",
		"Total tasks: $totalTasksCount",
		"Total completed tasks: $totalCompletedTasksCount",
		"Min tasks in a day: $minTasks",
		"Max tasks in a day: $maxTasks",
		"Average tasks per day: $averageTasksCount",
		"Average complete tasks per day: $averageCompletedTasksCount",
	];

	echo implode(PHP_EOL, $report) . PHP_EOL;
}

function prepareReportData(): array
{
	$files = scandir(ROOT . '/data'); // сохраняем массив с названиями всех файлов

	$allTodos = [];

	foreach ($files as $file)
	{
		// если название файла не совпадает с макетом (\d - строка \. = точка и тд)
		if (!preg_match('/^\d{4}-\d{2}-\d{2}\.txt$/', $file))
		{
			continue;
		}

		$content = file_get_contents(ROOT . '/data/' . $file); // сохраняем сериализованный контент из файла
		$todos = unserialize($content, ['allowed_classes' => false,]); // десериализуем, allowed_classes - для безопасности

		$todos = is_array($todos) ? $todos : []; // проверяем массив ли

		[$date] = explode('.', $file); // сохраняем название файла как дату
		$allTodos[$date] = $todos; // добавляем в массив одну тудушку
	}

	return $allTodos;
}