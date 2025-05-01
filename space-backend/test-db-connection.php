<?php

// Better environment loading
if (file_exists(__DIR__ . '/.env')) {
    // Load Composer's autoloader
    require_once __DIR__ . '/vendor/autoload.php';
    
    // Load environment using Laravel's environment loader
    try {
        $app = require_once __DIR__ . '/bootstrap/app.php';
        $app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();
        echo "✅ Environment loaded using Laravel bootstrap\n";
    } catch (Exception $e) {
        // Fallback to manual dotenv loading
        try {
            $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
            $dotenv->load();
            echo "✅ Environment loaded using Dotenv\n";
        } catch (Exception $e) {
            echo "❌ Failed to load environment: " . $e->getMessage() . "\n";
        }
    }
} else {
    echo "❌ .env file not found\n";
}

// Output environment variables being used
echo "\nTesting database connection with these parameters:\n";
echo "DB_CONNECTION: " . (env('DB_CONNECTION') ?: getenv('DB_CONNECTION') ?: 'Not set') . "\n";
echo "DB_HOST: " . (env('DB_HOST') ?: getenv('DB_HOST') ?: 'Not set') . "\n";
echo "DB_PORT: " . (env('DB_PORT') ?: getenv('DB_PORT') ?: 'Not set') . "\n";
echo "DB_DATABASE: " . (env('DB_DATABASE') ?: getenv('DB_DATABASE') ?: 'Not set') . "\n";
echo "DB_USERNAME: " . (env('DB_USERNAME') ?: getenv('DB_USERNAME') ?: 'Not set') . "\n";
echo "DB_PASSWORD: " . (env('DB_PASSWORD') ? '[Set]' : 'Not set') . "\n";
echo "DATABASE_URL: " . (env('DATABASE_URL') ?: getenv('DATABASE_URL') ?: 'Not set') . "\n\n";

// Try connecting with PDO
try {
    // Try using individual connection parameters first (local development)
    $host = env('DB_HOST') ?: getenv('DB_HOST') ?: 'localhost';
    $port = env('DB_PORT') ?: getenv('DB_PORT') ?: '3308';
    $database = env('DB_DATABASE') ?: getenv('DB_DATABASE') ?: 'space';
    $username = env('DB_USERNAME') ?: getenv('DB_USERNAME') ?: 'root';
    $password = env('DB_PASSWORD') ?: getenv('DB_PASSWORD') ?: '';
    
    echo "Attempting to connect using individual parameters:\n";
    echo "Host: $host, Port: $port, Database: $database, Username: $username\n";
    
    $dsn = "mysql:host=$host;port=$port;dbname=$database";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✅ Successfully connected to the database!\n";
    
    // Check if migrations table exists
    $stmt = $pdo->query("SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = DATABASE() AND table_name = 'migrations'");
    $hasMigrationsTable = (bool) $stmt->fetchColumn();
    
    echo $hasMigrationsTable 
        ? "✅ Migrations table exists\n" 
        : "❌ Migrations table does not exist\n";
    
} catch (PDOException $e) {
    echo "❌ Connection failed: " . $e->getMessage() . "\n";
    
    // Suggest potential fixes
    if (strpos($e->getMessage(), 'Access denied') !== false) {
        echo "\nPossible solutions:\n";
        echo "1. Check if MySQL is running on port $port\n";
        echo "2. Verify your MySQL username/password\n";
        echo "3. Try running: mysql -u root -p\n";
        echo "4. If you have a password, update it in .env\n";
    }
} 