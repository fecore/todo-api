<?php


namespace App\Providers;

use App\Controllers\TaskController;
use League\Container\ServiceProvider\AbstractServiceProvider;


class ControllerServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        TaskController::class,
    ];

    public function register()
    {
        $this->getContainer()->add(TaskController::class);
    }
}