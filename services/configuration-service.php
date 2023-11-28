<?php

function option(string $name, $defaultValue = null)
{
	/** @var array $config */
	static $config = null; // объявляем статической, чтобы каждый раз не подключать файл, потому что это дорого

	// один раз подключаем файл
	if ($config === null)
	{
		$masterConfig = require ROOT . '/config.php';
		if (file_exists(ROOT . '/config.local.php'))
		{
			$localConfig = require ROOT . '/config.local.php';
		}
		else
		{
			$localConfig = [];
		}

		$config = array_merge($masterConfig, $localConfig);
	}

	if (array_key_exists($name, $config))
	{
		return $config[$name];
	}

	if ($defaultValue !== null)
	{
		return $defaultValue;
	}

	throw new Exception("Configuration option $name not found");
}