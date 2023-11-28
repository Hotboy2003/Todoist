<?php

function getUserByLogin(string $login): ?array
{
	$userList = getUserList();
	$userIndex = array_search($login, array_column($userList, 'login'), true);
	if ($userIndex === false)
	{
		return null;
	}
	return $userList[$userIndex];
}

function getUserList()
{
	return [
		[
			'id' => 1,
			'login' => 'Alexandr',
			'password' => password_hash('123', PASSWORD_DEFAULT),
		],
		[
			'id' => 2,
			'login' => 'Ekaterina',
			'password' => password_hash('123', PASSWORD_DEFAULT),
		],
	];
}