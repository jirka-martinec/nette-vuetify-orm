<?php

declare(strict_types=1);

use Tracy\Debugger;

require __DIR__ . '/../vendor/autoload.php';

define('_WWW_DIR_', __DIR__);

function dd($var, string $title = null, array $options = []) {
    Debugger::barDump($var, $title, $options);
}

App\Bootstrap::boot()
	->createContainer()
	->getByType(Nette\Application\Application::class)
	->run();
