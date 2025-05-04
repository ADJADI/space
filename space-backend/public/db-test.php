<?php
// Direct database connection test - bypass Laravel
header('Content-Type: text/plain');

// Get DATABASE_URL from environment
$dbUrl = getenv('DATABASE_URL');

echo "Testing database connection with:\n";
echo "DATABASE_URL: " . (empty($dbUrl) ? 'Not set' : $dbUrl) . "\n\n";

if (empty($dbUrl)) {
    echo "ERROR: DATABASE_URL is not set\n";
    exit(1);
}

try {
    // Parse the URL
    $parts = parse_url($dbUrl);
    $host = $parts['host'] ?? null;
    $port = $parts['port'] ?? 3306;
    $database = ltrim($parts['path'] ?? '', '/');
    $username = $parts['user'] ?? null;
    $password = $parts['pass'] ?? null;
    
    echo "Parsed connection details:\n";
    echo "Host: $host\n";
    echo "Port: $port\n";
    echo "Database: $database\n";
    echo "Username: $username\n";
    echo "Password: " . (empty($password) ? 'Not set' : '[Set]') . "\n\n";
    
    // Try to connect
    echo "Attempting to connect to MySQL server...\n";
    $dsn = "mysql:host=$host;port=$port";
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_TIMEOUT => 5,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    
    echo "✅ Successfully connected to MySQL server!\n\n";
    
    // Try to select the database
    echo "Attempting to select database '$database'...\n";
    $pdo->query("USE `$database`");
    echo "✅ Successfully selected database!\n\n";
    
    // Try to create a simple table
    try {
        echo "Checking if any tables exist...\n";
        $stmt = $pdo->query("SHOW TABLES");
        $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        if (count($tables) > 0) {
            echo "Existing tables:\n";
            foreach ($tables as $table) {
                echo "- $table\n";
            }
        } else {
            echo "No tables found in database.\n";
        }
        
        echo "\nTrying to run a simple query...\n";
        
        // Check if migrations table exists
        $stmt = $pdo->query("SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = '$database' AND table_name = 'migrations'");
        $hasMigrationsTable = (bool) $stmt->fetchColumn();
        
        echo $hasMigrationsTable 
            ? "✅ Migrations table exists!\n" 
            : "❌ Migrations table does not exist.\n";
            
        if (!$hasMigrationsTable) {
            echo "\nCreating a test table to verify write permissions...\n";
            $pdo->exec("CREATE TABLE test_connection (id INT AUTO_INCREMENT PRIMARY KEY, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)");
            $pdo->exec("INSERT INTO test_connection VALUES (NULL, NOW())");
            echo "✅ Successfully created and wrote to test table!\n";
        }
        
    } catch (PDOException $e) {
        echo "❌ Could not run queries: " . $e->getMessage() . "\n";
    }
    
} catch (PDOException $e) {
    echo "❌ Connection failed: " . $e->getMessage() . "\n";
    
    if (strpos($e->getMessage(), 'Access denied') !== false) {
        echo "\nPossible solutions:\n";
        echo "1. Check username/password\n";
        echo "2. Verify user has access to the database\n";
    }
    
    if (strpos($e->getMessage(), 'Connection refused') !== false) {
        echo "\nPossible solutions:\n";
        echo "1. Verify MySQL is running\n";
        echo "2. Check host/port\n";
        echo "3. Make sure network allows connections between services\n";
    }
}
?> 