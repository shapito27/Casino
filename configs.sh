#!/bin/bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan casino:createRoles
php artisan casino:createModerator
php artisan casino:createSubjects


