@echo off
echo Starting Payment Verification System on port 9000...
echo.
cd /d "%~dp0"
php -S 127.0.0.1:9000 -t public
echo.
echo Server stopped.
pause
