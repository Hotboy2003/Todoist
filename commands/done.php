<?php
function doneCommand(array $arguments)
{
	$todos = getTodosOrFail();

	$now = time(); //текущее время

	// пробегаемся по массиву переданных значений

	// слияние существующего массива с новым (по сути переобозначение)
	$todos = mapTodos($todos, $arguments, function ($todo) use ($now)
	{
		return array_merge($todo, [
			'completed' => true,
			'updated_at' => $now,
			'completed_at' => $now,
			]);
	});

	storeTodos($todos);
}