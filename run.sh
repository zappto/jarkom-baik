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
composer install --no-interaction --prefer-dist

print_step "2. Setup Environment"
if [ ! -f .env ]; then
    cp .env.example .env
    echo "  => .env file created"
fi

if ! grep -q "^APP_KEY=" .env || [ "$(grep "^APP_KEY=" .env | cut -d= -f2)" = "" ]; then
    php artisan key:generate --force
    echo "  => APP_KEY generated"
fi

print_step "3. Install Node Dependencies & Build"
npm install
npm run build

print_step "4. Install tailwindcss native binding (Windows fix)"
npm install @tailwindcss/oxide-win32-x64-msvc --no-save 2>/dev/null || true

print_step "5. Run Database Migration & Seeder"
php artisan migrate:fresh --seed --force

print_step "6. Generate Application URL"
APP_URL=$(grep "^APP_URL=" .env | cut -d= -f2)
APP_URL="${APP_URL:-http://localhost}"
echo "  => Application URL: $APP_URL"

print_step "7. Start Development Server"
echo ""
echo "  Application is running at: $APP_URL"
echo "  Press Ctrl+C to stop."
echo ""

php artisan serve --host=0.0.0.0
