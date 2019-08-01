<?php


namespace App\Providers;

use League\Container\ServiceProvider\AbstractServiceProvider;
use Zend\Diactoros\ServerRequestFactory;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;


class HttpServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        'SapiEmitter',
        'ServerRequest',
    ];

    public function register()
    {
        $this->getContainer()->share('SapiEmitter', function (){
            return new SapiEmitter;
        });

        $this->getContainer()->share('ServerRequest', function () {
            return ServerRequestFactory::fromGlobals();
        });
    }
}