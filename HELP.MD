
Useful Commands
===============

// Start Laravel app on Development mode at: http://127.0.0.1:8000 OR http://localhost:8000
$composer run dev

// Run ALL DB migration files since last Batch number
$php artisan migrate

// Create new Laravel example-app project with files created inside folder: example-app
$laravel new example-app

// Install Laravel Breeze (OR other Laravel packages using Composer)
$composer require laravel/breeze

// Build Laravel Breeze package Scaffolding and Dependencies (OR other Laravel packages)
$php artisan breeze:install

// Install Laravel DebugBar package as Dev dependancy to test how many queries are executed
$composer require barryvdh/laravel-debugbar --dev

// Install Laravel module installer Globally
$composer global require laravel/installer

// Show all available package suggestions for installation
$composer suggest --all

// Install NodeJS Dependencies defined inside folder: node_modules
$npm install

// Run Laravel built-in server
$php artisan serve

// Print PHP variable inside blade template file OR
@dump($test)

// Print PHP variable inside blade template file
@php
    var_dump($test);
@endphp


==============================================================================================================

Useful Links
============

https://laraveldaily.com/roadmap-learning-path

https://laraveldaily.com/lesson/laravel-beginners/install-composer-installer

https://laraveldaily.com/lesson/vue-laravel-vite-spa-crud/spa-install-laravel-vue-first-vuejs-component

https://startbootstrap.com/template/blog-home
