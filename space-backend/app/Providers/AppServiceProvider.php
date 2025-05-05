<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use PDO;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        if ($this->app->runningInConsole() && $this->app->environment() !== 'production') {
            $this->createDatabaseIfNotExists();
        }
    }


    public function boot()
    {
        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }
    }


    private function createDatabaseIfNotExists(): void
    {
        $connection = config('database.default');
        $database = config("database.connections.{$connection}.database");

        try {
            $pdo = new PDO(
                sprintf(
                    '%s:host=%s;port=%s;charset=%s',
                    config("database.connections.{$connection}.driver"),
                    config("database.connections.{$connection}.host"),
                    config("database.connections.{$connection}.port"),
                    config("database.connections.{$connection}.charset"),
                ),
                config("database.connections.{$connection}.username"),
                config("database.connections.{$connection}.password"),
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );

            $pdo->exec(sprintf(
                'CREATE DATABASE IF NOT EXISTS `%s` CHARACTER SET %s COLLATE %s;',
                $database,
                config("database.connections.{$connection}.charset"),
                config("database.connections.{$connection}.collation", 'utf8mb4_unicode_ci')
            ));
        } catch (\Exception $e) {

        }
    }
}
