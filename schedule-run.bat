@echo off
cd /d D:\WORK\Portofolio\AnnurNetwork
php artisan schedule:run >> scheduler-log.txt 2>&1
