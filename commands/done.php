<?php
function doneCommand(array $arguments)
{
	$todos = getTodosOrFail();

	$now = time(); //текущее время

	// пробегаемся по массиву переданных значений
	foreach ($arguments as $num)
	{
		$index = (int)$num - 1;
		// если нет элемента с таким индексом
		if (!isset($todos[$index]))
		{
			continue;
		}

		// слияние существующего массива с новым (по сути переобозначение)
		$todos[$index] = array_merge($todos[$index], [
			'completed' => true,
			'updated_at' => $now,
			'completed_at' => $now,
		]);
	}

	storeTodos($todos);
}