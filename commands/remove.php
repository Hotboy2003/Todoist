<?php
function removeCommand(array $arguments)
{
	$todos = getTodosOrFail(); // получить тудушки

	$todos = mapTodos($todos, $arguments, fn($todo) => null); // удалить тудушку

	storeTodos($todos); // сохранить массив в файле
}