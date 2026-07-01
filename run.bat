@echo off
cd /d "%~dp0"

echo ========================================
echo  1. Install PHP Dependencies
echo ========================================
call composer install --no-interaction --prefer-dist

echo.
echo ========================================
echo  2. Setup Environment
echo ========================================
if not exist .env (
    copy .env.example .env
    echo   ^>^> .env file created
)

php artisan key:generate --force

echo.
echo ========================================
echo  3. Install Node Dependencies
echo ========================================
call npm install

echo.
echo ========================================
echo  4. Build Frontend
echo ========================================
call npm run build

echo.
echo ========================================
echo  5. Run Database Migration ^& Seeder
echo ========================================
php artisan migrate:fresh --seed --force

echo.
echo ========================================
echo  6. Start Development Server
echo ========================================
echo.
echo  Application running at: http://localhost:8000
echo  Press Ctrl+C to stop.
echo.
php artisan serve
