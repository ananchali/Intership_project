@echo off
echo Starting Afronex Hosting Server...
echo.
cd /d "%~dp0"
php -S 127.0.0.1:8888 -t public
echo.
echo Server stopped.
pause
 