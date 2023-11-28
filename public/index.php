<?php
// работа с данными в начале
require_once __DIR__ . '/../boot.php';

$config = require_once ROOT . '/config.php';

$appTitle = option('APP_NAME', 'Todoist');
$time = null;
$isHistory = false;
$errors = []; // пустой массив с ошибками

// Проверка вошел ли пользователь в свой аккаунт
session_start();
// если нет, то кидаем его на страницу ввода логина пароля
if (!isset($_SESSION['USER']))
{
	redirect('login.php');
}

// если после ? что то передано
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	$title = trim($_POST['title']); // запоминаем что передали

	if (strlen($title) > 0)
	{
		$todo = createTodo($title); // создаем тудушку
		addTodo($todo); // закидываем в массив ко всем тудушкам

		redirect('/');// заново открыть главную страницу, чтобы post запрос не повторялся
	}
	else
	{
		$errors[] = 'Task cannot be empty';
	}
}

// если после ? передана date
if (isset($_GET['date']))
{
	$time = strtotime($_GET['date']);
	if ($time === false)
	{
		$time = time();
	}

	// если сегодняшняя дата не совпадает с переданной, то указываем, что мы показываем историю пользователю
	$today = date('Y-m-d');
	if ($today !== date('Y-m-d', $time))
	{
		$isHistory = true;
		$title = sprintf('Todoist :: %s', date('j M', $time));
	}
}

echo view('layout', [
	'title' => $appTitle,
	'bottomMenu' => require ROOT . '/menu.php',
	'content' => view('pages/index', [
		'todos' => getTodos($time),
		'isHistory' => $isHistory,
		'errors' => $errors,
	]),
]);