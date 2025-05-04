#!/bin/bash

echo "Waiting for database connection..."
MAX_RETRIES=30
RETRY_COUNT=0

while [ $RETRY_COUNT -lt $MAX_RETRIES ]; do
    # Try to connect to the database
    php -r "
    \$url = getenv('DATABASE_URL');
    if (empty(\$url)) {
        echo \"DATABASE_URL is not set\\n\";
        exit(1);
    }
    echo \"Trying to connect to: \$url\\n\";
    
    try {
        \$parts = parse_url(\$url);
        \$host = \$parts['host'] ?? null;
        \$port = \$parts['port'] ?? 3306;
        \$database = ltrim(\$parts['path'] ?? '', '/');
        \$username = \$parts['user'] ?? null;
        \$password = \$parts['pass'] ?? null;
        
        echo \"Connecting to MySQL: host=\$host, port=\$port, database=\$database, user=\$username\\n\";
        
        \$dsn = \"mysql:host=\$host;port=\$port\";
        \$pdo = new PDO(\$dsn, \$username, \$password, [PDO::ATTR_TIMEOUT => 5]);
        \$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        echo \"Successfully connected to database server!\\n\";
        
        // Try to create database if it doesn't exist
        \$pdo->exec(\"CREATE DATABASE IF NOT EXISTS `\$database`\");
        echo \"Ensured database '\$database' exists\\n\";
        
        exit(0);
    } catch (Exception \$e) {
        echo \"Connection failed: \" . \$e->getMessage() . \"\\n\";
        exit(1);
    }
    "
    
    if [ $? -eq 0 ]; then
        echo "Database is ready!"
        exit 0
    fi
    
    echo "Database not ready yet, retrying in 2 seconds (attempt $RETRY_COUNT of $MAX_RETRIES)..."
    sleep 2
    RETRY_COUNT=$((RETRY_COUNT+1))
done

echo "Could not connect to database after $MAX_RETRIES attempts"
exit 1 