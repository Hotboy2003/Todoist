<?php

require_once __DIR__ . '/boot.php';



function main(array $arguments): void
{
	array_shift($arguments); //убираем первый элемент массива (путь файла)

	$command = array_shift($arguments); //смотрим команду

	switch ($command)
	{
		case "list":
			listCommand($arguments);
			break;
		case "add":
			addCommand($arguments);
			break;
		case "done":
			doneCommand($arguments);
			break;
		case "undone":
			undoneCommand($arguments);
			break;
		case "remove":
		case "rm":
			removeCommand($arguments);
			break;
		case "report":
			reportCommand($arguments);
			break;
		default:
			echo "Unknown command";
			exit(1);
	}
}

main($argv);