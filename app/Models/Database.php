<?php

namespace App\Models;
use Illuminate\Database\Capsule\Manager as Capsule;

class Database {

    function __construct($config, Capsule $capsule)
    {

        $capsule->addConnection([
            'driver' => $config['db.driver'],
            'host' =>  $config['db.host'],
            'database' =>  $config['db.database'],
            'username' =>  $config['db.username'],
            'password' =>  $config['db.password'],
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);

        $capsule->setAsGlobal();

        // Setup the Eloquent ORM…
        $capsule->bootEloquent();
    }

}