<?php
// работа с данными в начале
require_once __DIR__ . '/../boot.php';

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

echo view('layout', [
	'title' => 'Todoist::Report',
	'bottomMenu' => require_once ROOT . '/menu.php',
	'content' => view('pages/report', [
		'report' => $report,
	]),
]);