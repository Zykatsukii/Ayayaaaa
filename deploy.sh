#!/bin/bash

# Create database directory if it doesn't exist
mkdir -p /tmp

# Run migrations
php artisan migrate --force

# Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Generate application key if not set
php artisan key:generate --force

# Start the application
php artisan serve --host=0.0.0.0 --port=$PORT 