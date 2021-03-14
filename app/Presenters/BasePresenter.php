<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;


abstract class BasePresenter extends Nette\Application\UI\Presenter
{
    /**
     * @throws Nette\Utils\JsonException
     */
    protected function beforeRender(): void
    {
        parent::beforeRender();
        
        $this->template->entrypoints = $this->getEntrypoints();
    }

    /**
     * @return mixed
     * @throws Nette\Utils\JsonException
     */
    protected function getEntrypoints(): mixed
    {
        $file = Nette\Utils\FileSystem::read(_WWW_DIR_ . '/build/entrypoints.json');

        return Nette\Utils\Json::decode($file)->entrypoints;
    }
}
