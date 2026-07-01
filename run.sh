#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "$0")" && pwd)"
cd "$ROOT_DIR"

print_step() {
    echo ""
    echo "========================================"
    echo "  $1"
    echo "========================================"
}

print_step "1. Install PHP Dependencies"
composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --prefer-dist

print_step "2. Setup Environment"
if [ ! -f .env ]; then
    cp .env.example .env
    echo "  => .env file created"
fi

if ! grep -q "^APP_KEY=" .env || [ -z "$(grep "^APP_KEY=" .env | cut -d= -f2)" ]; then
    php artisan key:generate --force
    echo "  => APP_KEY generated"
fi

print_step "3. Install Node Dependencies & Build Assets"
npm ci
npm run build

print_step "4. Laravel Optimization"
php artisan storage:link --force 2>/dev/null || true

php artisan optimize:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache

print_step "5. Database Migration"
php artisan migrate --force

print_step "6. Deployment Complete"

APP_URL=$(grep "^APP_URL=" .env | cut -d= -f2)
APP_URL="${APP_URL:-http://localhost}"

echo ""
echo "========================================"
echo " Deployment Finished Successfully"
echo "========================================"
echo ""
echo "Application URL : $APP_URL"
echo ""
echo "Make sure your Apache DocumentRoot points to:"
echo "    $(pwd)/public"
echo ""
echo "Apache should now serve the application."