<?php

function createTodo(string $title): array
{
	return [
		'id' => uniqid('', true), //псевдоуникальный id
		'title' => $title,
		'completed' => false,
		'created_at' => time(),
		'updated_at' => null,
		'completed_at' => null,
	];
}

function mapTodos(array $todos, array $positions, Closure $callback): array
{
	// пробегаемся по массиву переданных значений
	foreach ($positions as $position)
	{
		$index = (int)$position - 1;
		// если нет элемента с таким индексом
		if (!isset($todos[$index]))
		{
			continue;
		}

		$result = $callback($todos[$index]); // слияние существующего массива с новым (по сути переобозначение)

		// если массив
		if (is_array($result))
		{
			$todos[$index] = $result;
		} else
		{
			unset($todos[$index]); // если команда remove
		}



	}

	// возвращаем значения массива
	return array_values($todos);
}