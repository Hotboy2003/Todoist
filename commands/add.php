<?php
function addCommand(array $arguments)
{
	$title = array_shift($arguments); // берем названием первый элемент массива

	$todo = createTodo($title); // создаем массив todo

	addTodo($todo); // добавляем в массив со всеми тудушками
}