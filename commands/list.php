<?php
function listCommand(array $arguments)
{
	$time = null;

	if (!empty($arguments))
	{
		$date = array_shift($arguments);
		$time = strtotime($date);
		if ($time === null)
		{
			echo "Invalid date \n";
			exit(1);
		}
	}


	$todos = getTodosOrFail($time);

	// вывод названий дел
	foreach ($todos as $index => $todo)
	{
		echo sprintf("%s. [%s] %s \n",
			($index + 1),
					 $todo['completed'] ? 'x' : ' ',
					 $todo['title']);
	}
}