<?php

use \Psr\Http\Message\ServerRequestInterface;
use \League\Route\Strategy\ApplicationStrategy;

// Defining routes

$router->map('GET', '/task', 'App\Controllers\TaskController::index');

$router->map('POST', '/task', 'App\Controllers\TaskController::store');

$router->map('GET', '/task/{id}', 'App\Controllers\TaskController::show');

$router->map('PUT', '/task/{id}', 'App\Controllers\TaskController::update');

$router->map('DELETE', '/task/{id}', 'App\Controllers\TaskController::destroy');