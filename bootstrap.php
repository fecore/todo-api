<?php

require 'vendor/autoload.php';

use Dotenv\Dotenv;
use App\Models\Database;
use Illuminate\Database\Capsule\Manager as Capsule;
use League\Container\Container;
use League\Route\Router;
use League\Route\Strategy\JsonStrategy;
use Zend\Diactoros\ResponseFactory;

// Load env
$dotenv = new DotEnv(__DIR__);
$dotenv->load();

// Register ServiceProviders
$container = new Container();
$container->addServiceProvider(App\Providers\HttpServiceProvider::class);
$container->addServiceProvider(App\Providers\ConfigServiceProvider::class);
$container->addServiceProvider(App\Providers\ControllerServiceProvider::class);

// Database
// And ORM
new Database($container->get('config'), new Capsule);


// Register Routes
$request = $container->get('ServerRequest');

$responseFactory = new ResponseFactory;

$strategy = new JsonStrategy($responseFactory);
$router   = (new Router)->setStrategy($strategy);

// Map routes
require 'routes.php';

$response = $router->dispatch($request);

// Send the response to the browser
$container->get('SapiEmitter')->emit($response);