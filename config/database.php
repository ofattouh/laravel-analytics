<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for database operations. This is
    | the connection which will be utilized unless another connection
    | is explicitly specified when you execute a query / statement.
    |
    */

    'default' => env('DB_CONNECTION', 'sqlite'),        // default installation Database
    // 'default' => env('DB_CONNECTION', 'mysql'),      // use MySQL Database instead

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Below are all of the database connections defined for your application.
    | An example configuration is provided for each database system which
    | is supported by Laravel. You're free to add / remove connections.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'url' => env('DB_URL'),
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
            'busy_timeout' => null,
            'journal_mode' => null,
            'synchronous' => null,
        ],

        'mysql' => [
            'driver' => 'mysql',
            'url' => env('DB_URL'), // env() helper takes values from .env file which are called environment variables
            'host' => env('DB_HOST', '127.0.0.1'),  // NEVER use env() helper in code outside config files
            'port' => env('DB_PORT', '3306'),
            // 'database' => env('DB_DATABASE', 'laravel'),
            'database' => env('DB_DATABASE', 'evaluation-analytics-dev'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => env('DB_CHARSET', 'utf8mb4'),
            'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        'mariadb' => [
            'driver' => 'mariadb',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'laravel'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => env('DB_CHARSET', 'utf8mb4'),
            'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'laravel'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => env('DB_CHARSET', 'utf8'),
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', 'laravel'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => env('DB_CHARSET', 'utf8'),
            'prefix' => '',
            'prefix_indexes' => true,
            // 'encrypt' => env('DB_ENCRYPT', 'yes'),
            // 'trust_server_certificate' => env('DB_TRUST_SERVER_CERTIFICATE', 'false'),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run on the database.
    |
    */

    'migrations' => [
        'table' => 'migrations',
        'update_date_on_publish' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer body of commands than a typical key-value system
    | such as Memcached. You may define your connection settings here.
    |
    */

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_database_'),
            'persistent' => env('REDIS_PERSISTENT', false),
        ],

        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'),
        ],

        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_CACHE_DB', '1'),
        ],

    ],

];


/*

    In Laravel, NO need to create tables with columns manually. Laravel uses migrations where migration schema
    is defined inside a migration file and then run the migrations, creating tables with columns

    Migrations are added in the database/migrations folder. When creating new Laravel project, there are three
    migration files. Usually, 1 Migration file would create one table. Laravel by default, creates 3 tables
    corresponding to users using 1 of the 3 migration files

    When using the default installation database driver SQLite, migrations are run automatically after
    creating new project. If you use any other database driver, the database will be empty initially

    To run migrations, use artisan command: `php artisan migrate` in the terminal which will run all migrations
    from the database/migrations folder

    To create Migration for DB table categories. Use artisan command: `php artisan make:migration`.
    and as parameter, specify: "create [table name] table" in quotation marks or underscores such as:
    `php artisan make:migration "create categories table"` OR
    `php artisan make:migration create_categories_table`

    When running migrate artisan command, it only migrates migrations that haven't been executed yet. Laravel
    has table called migrations that stores all migrations that have been run, with their batch number.
    When we run the migration, a new record is inserted for the new categories table and batch number is updated

    Laravel use database to manage sessions by default

    Useful DB commands:

    `php artisan db:show`                 // Show information about DB and tables

    `php artisan db:table TABLE_NAME`     // Show information about specific table

    `php artisan make:migration "create categories table""`  // create Migration for DB table Categories
    `php artisan make:migration create_categories_table`     // create Migration for DB table Categories

    `php artisan migrate`                 // Run all migrations files

    `php artisan migrate:fresh`           // Rebuild database if already existed and run last batch installation tables

    `php artisan migrate:rollback`        // Rollback command will only roll back migrations to last batch number

    `composer dump-autoload`              // Regenerate Composer autoload files and ensures all classes are autoloaded

    `php artisan config:cache`            // Clear and rebuild application cache

    `php artisan cache:clear`             // Clear and rebuild application cache

    `php artisan make:model Category`     // Create Model:Category class file (1 artisan command)

    `php artisan make:model Post -m`      // Create Model:Post class file and Migration:xxx_create_posts_table file (2 artisan commands)


    https://laraveldaily.com/lesson/laravel-beginners/db-structure-migrations-env-config

*/
