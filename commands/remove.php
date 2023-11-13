<?php
function removeCommand(array $arguments)
{
	$todos = getTodosOrFail();

	// пробегаемся по массиву переданных значений
	foreach ($arguments as $num)
	{
		$index = (int)$num - 1;
		// если нет элемента с таким индексом
		if (!isset($todos[$index]))
		{
			continue;
		}

		unset($todos[$index]); // удаление задачи
	}

	$todos = array_values($todos); // восстанавливаем индексы, чтобы все шло по порядку
	file_put_contents($filePath, serialize($todos)); // кладем сериализованные данные в файл
}