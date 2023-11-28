<?php
// работа с данными в начале
require_once __DIR__ . '/../boot.php';

$errors = []; // пустой массив с ошибками

// если после ? что то передано
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	$login = $_POST['login'];
	$password = $_POST['password'];
	$error = 'Invalid login or password';

	// 1. Индентификация
	$user = getUserByLogin($login);
	if (!$user)
	{
		$errors[] = $error;
	}
	else
	{
		// 2. Аутентификация
		$isPasswordCorrect = password_verify($password, $user['password']);
		if (!$isPasswordCorrect)
		{
			$errors[] = $error;
		}
		if (empty($errors))
		{
			session_start();
			$_SESSION['USER'] = $user;
			redirect('index.php');
			exit();
		}
	}
}

echo view('layout', [
	'title' => 'Todoist',
	'content' => view('pages/login', [
		'errors' => $errors,
	]),
]);