#!/bin/bash
php artisan config:clear
php artisan casino:createRoles
php artisan casino:createModerator
php artisan casino:createSubjects


