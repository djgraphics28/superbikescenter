#!/bin/bash

# Define the path to your Laravel application
APP_PATH="/domains/superbikescentral.online/public_html"

# Change to the application directory
cd $APP_PATH

# Function to check if the queue worker is running
is_queue_running() {
    pgrep -f "php artisan queue:work" > /dev/null
    return $?
}

# Check if the queue worker is running
if is_queue_running; then
    echo "Queue worker is running. Restarting queue worker..."
    php artisan queue:restart
else
    echo "Queue worker is not running. Starting queue worker..."
    nohup php artisan queue:work --daemon --sleep=3 --tries=3 > /dev/null 2>&1 &
fi

echo "Queue worker process completed successfully!"
