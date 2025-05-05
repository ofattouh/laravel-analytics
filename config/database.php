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

    // 'default' => env('DB_CONNECTION', 'sqlite'),  // Default installation Database
    'default' => env('DB_CONNECTION', 'mysql'),      // Use MySQL Database

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
            //'host' => env('DB_HOST', '127.0.0.1'),  // NEVER use env() helper in code outside config files
            'host' => env('DB_HOST', 'local-2.evaluation.pshsa.ca'),
            'port' => env('DB_PORT', '3306'),
            // 'database' => env('DB_DATABASE', 'laravel'),
            'database' => env('DB_DATABASE', 'evaluation-analytics-dev'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => env('DB_CHARSET', 'utf8mb4'), // Laravel uses utf8mb4 character set and collation by default
            'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'), // Store extended multibyte characters such as "emojis"
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            // 'engine' => null, // Cause MySQL error: Specified key was too long; max key length is 1000 bytes (MyISAM)
            // 'engine' => 'InnoDB ROW_FORMAT=DYNAMIC', // Fix above MySQL error OR
            'engine' => 'InnoDB',                       // Fix above MySQL error
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

    When using the default installation Database driver SQLite, migrations are run automatically after
    creating new project. If you use any other Database driver, the Database will be empty initially

    To run migrations, use artisan command: `php artisan migrate` in the terminal which will run all migrations
    from the database/migrations folder

    To create Migration for DB table categories. Use artisan command: `php artisan make:migration`.
    and as parameter, specify: "create [table name] table" in quotation marks or underscores such as:
    `php artisan make:migration "create categories table"` OR
    `php artisan make:migration create_categories_table`

    When running migrate artisan command, it only migrates migrations that haven't been executed yet. Laravel
    has table called migrations that stores all migrations that have been run, with their batch number.
    When we run the migration, a new record is inserted for the new categories table and batch number is updated

    Laravel use the Database to manage sessions by default

    Inside database folder, there are three sub-folders: migrations, factories: which describe fake data
    values/rules for each Model, and seeds: which describe data to be seeded, and may/not use factories.
    Migrations are about structure of database, and Factories/Seeds are about the data itself and values


    Useful DB commands:

    `php artisan db:show`                 // Show information about DB and tables

    `php artisan db:table TABLE_NAME`     // Show information about specific table

    `php artisan make:migration "create categories table""`  // create Migration for DB table Categories
    `php artisan make:migration create_categories_table`     // create Migration for DB table Categories

    `php artisan serve`                   // Run Laravel server

    `php artisan migrate`                 // Run ALL Database migrations files

    `php artisan migrate:fresh`           // Rebuild Database if already existed and run last batch installation tables

    `php artisan migrate:reset`           // Rebuild Database if already existed and run last batch installation tables

    `php artisan migrate:rollback`        // Rollback DB command will only roll back migrations to last batch number

    `php artisan db:wipe`                 // Delete/drop all tables of Database

    `composer dump-autoload`              // Regenerate Composer autoload files and ensures all classes are autoloaded

    `php artisan config:clear`            // Clear/refresh configuration cache (Helpful to fix config errors)

    `php artisan cache:clear`             // Clear application cache

    `php artisan config:cache`            // Rebuild app configuration cache

    `php artisan make:model Category`     // Create Model:Category class file (1 artisan command)

    `php artisan make:model Post -m`      // Create Model:Post class file and Migration:xxx_create_posts_table file (2 artisan commands)

    `php artisan make:model Task -mc`     // Create Model:Task with Migration and Controller files (3 artisan commands)

    `php artisan make:migration "add is admin to users table"` // Add is_admin boolean column field to users table

    `php artisan make:migration "add category to posts table"` // Add foreign key column:category_id to Posts table

    `php artisan make:seeder AdminSeeder` // Generate seeder class inside database/seeders folder for admin user

    `php artisan make:seeder PostSeeder`  // Generate seeder class inside database/seeders folder for Post table

    `php artisan make:factory TaskFactory -model=Task` // Generate Task factory:TaskFactory for Model:Task (DB seeds)

    `php artisan make:factory PostFactory`             // Generate Post factory (for table:Post seed values)

    `php artisan db:seed`                 // Run other seeder classes in:seeders/DatabaseSeeder, add all seeder values

    `php artisan migrate:refresh --seed`  // (Run ONLY in Development) Refresh ALL seeding data and ALL migration tables data

    // Create Resource Controller:CategoryController with Model:Category, add type-hinted models for controller methods
    `php artisan make:controller CategoryController --resource --model=Category`
    `php artisan make:controller PostController --resource --model=Post`

    `php artisan make:controller Api/PostController`     // Create controller:PostController for API endpoint
    `php artisan make:controller Api/CategoryController` // Create controller:CategoryController for API endpoint

    `php artisan route:list`                         // Check available Routes

    `php artisan make:middleware IsAdminMiddleware` // Create custom Middleware:IsAdminMiddleware to check if user is admin

    `php artisan make:request StorePostRequest`     // Create Form class:StorePostRequest with Laravel validation rules

    `php artisan install:api`                       // Prepare Laravel application for API routes

    `php artisan config:publish cors`               // Publish cors configuration file in config/cors.php

    `php artisan make:resource PostResource`        // Create Eloquent API Resource class:PostResource
    `php artisan make:resource CategoryResource`    // Create Eloquent API Resource class:CategoryResource


    https://laraveldaily.com/lesson/laravel-beginners/db-structure-migrations-env-config

*/
