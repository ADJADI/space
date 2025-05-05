<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateDatabaseCommand extends Command
{
    protected $signature = 'db:create';
    protected $description = 'Create a new database based on .env settings';

    public function handle()
    {
        $databaseName = config('database.connections.mysql.database');
        
        $charset = config('database.connections.mysql.charset', 'utf8mb4');
        $collation = config('database.connections.mysql.collation', 'utf8mb4_unicode_ci');

        try {
            $connection = config('database.default');
            
            $query = "CREATE DATABASE IF NOT EXISTS `$databaseName` CHARACTER SET $charset COLLATE $collation;";
            
            DB::connection($connection)
                ->getPdo()
                ->exec($query);

            $this->info("Database '$databaseName' created successfully.");
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            return Command::FAILURE;
        }
    }
} 