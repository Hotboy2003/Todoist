<?php
function addCommand(array $arguments)
{
	$title = array_shift($arguments); // берем названием первый элемент массива

	// создаем массив todo
	$todo = [
		'id' => uniqid('', true), //псевдоуникальный id
		'title' => $title,
		'completed' => false,
		'created_at' => time(),
		'updated_at' => null,
		'completed_at' => null,
	];

	$todos = getTodos();
	$todos[] = $todo; // добавляем новую задачу

	storeTodos($todos); // кладем в файл

}