#!/bin/bash

echo "Starting application deployment process..."

# Clear application cache
php artisan config:clear
php artisan cache:clear
php artisan route:clear

# Wait for database to be ready
echo "Waiting for database connection..."
MAX_RETRIES=30
RETRY_COUNT=0

while [ $RETRY_COUNT -lt $MAX_RETRIES ]; do
    php artisan db:monitor > /dev/null 2>&1
    if [ $? -eq 0 ]; then
        echo "Database connection successful!"
        break
    fi
    
    echo "Database not ready yet, retrying in 5 seconds..."
    sleep 5
    RETRY_COUNT=$((RETRY_COUNT+1))
done

if [ $RETRY_COUNT -eq $MAX_RETRIES ]; then
    echo "Could not connect to database after multiple attempts. Check your database configuration."
    exit 1
fi

# Run migrations
echo "Running database migrations..."
php artisan migrate --force

# Build assets
echo "Building frontend assets..."
npm run build

# Start web server
echo "Starting web server..."
php artisan serve --host=0.0.0.0 --port=${PORT:-8000} 