<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use PDO;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // If running in console mode, and not in production
        if ($this->app->runningInConsole() && $this->app->environment() !== 'production') {
            $this->createDatabaseIfNotExists();
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Create the database if it doesn't exist
     */
    private function createDatabaseIfNotExists(): void
    {
        $connection = config('database.default');
        $database = config("database.connections.{$connection}.database");

        try {
            // Try to connect without specifying a database
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

            // Create the database if it doesn't exist
            $pdo->exec(sprintf(
                'CREATE DATABASE IF NOT EXISTS `%s` CHARACTER SET %s COLLATE %s;',
                $database,
                config("database.connections.{$connection}.charset"),
                config("database.connections.{$connection}.collation", 'utf8mb4_unicode_ci')
            ));
        } catch (\Exception $e) {
            // We'll log this silently - a more detailed error will be thrown
            // by Laravel if the database truly cannot be accessed
        }
    }
}
