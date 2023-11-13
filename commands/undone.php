<?php
function undoneCommand(array $arguments)
{
	$todos = getTodosOrFail();

	// пробегаемся по массиву переданных значений
	foreach ($arguments as $num)
	{
		$index = (int)$num - 1;

		// если элемента с таким индексом нет
		if (!isset($todos[$index]))
		{
			continue;
		}

		// слияние существующего массива с новым (по сути переобозначение)
		$todos[$index] = array_merge($todos[$index], [
			'completed' => false,
			'updated_at' => time(),
			'completed_at' => null,
		]);
	}

	storeTodos($todos);
}