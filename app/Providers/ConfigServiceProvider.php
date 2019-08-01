<?php


namespace App\Providers;

use League\Container\ServiceProvider\AbstractServiceProvider;

// Replaces default configuration values
// with values from .env file

class ConfigServiceProvider extends AbstractServiceProvider
{
    protected $provides = ['config'];

    public function register()
    {
        $this->getContainer()->share('config', function() {
            return [
                'app.name' => getenv('APP_NAME') ?: 'Default',
                'app.env' =>  getenv('APP_ENV') ?: 'local',

                'db.driver' => getenv('DB_DRIVER') ?: 'mysql',
                'db.host' =>   getenv('DB_HOST')   ?: 'localhost',
                'db.port' =>   getenv('DB_PORT')   ?: '3306',
                'db.database' => getenv('DB_DATABASE') ?: '',
                'db.username' => getenv('DB_USERNAME') ?: 'root',
                'db.password' => getenv('DB_PASSWORD') ?: '',
            ];
        });
    }
}