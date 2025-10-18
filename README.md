[Laravel-Tailwind](https://gitlab.com/mathiasappelmans/laravel-tailwind)

# This is a Laravel-Tailwind e-shop demo

### Laravel topics included:

- routes
- views 
- controllers
- models (factories, seeders)
- database multi-connections
- tests phpunit and features tests

### Install and serve on localhost

* Copy .env.example and rename .env or .env local
* Configure your .env file database connection
    * for SQLite, your system need php SQLite installation
    [https://doc.dotdev.be/sql/sqlite](https://doc.dotdev.be/sql/sqlite)
    ```
    Activate extension=pdo_sqlite in php.ini
    ```
    Create your DB file in /database folder or copy paste an existing sqlite file from anywhere
    ```
    # create new file
    touch database/database.sqlite
    ```
    * Install VSCode extension SQLite3 editor from yy0931 to view and manage your DB
* Generate your APP_KEY
```
php artisan key:generate
```
- run `composer install` // vendor dependencies (composer.json)
- run `npm install --force && npm run dev` // node_modules default frontend dependencies (package.json)
- run `php artisan migrate`, create tables and populate 'product' table
- you can change the populate migration, run `php artisan migrate:rollback`, change the migrations files and run `php artisan migrate`
- run `php artisan serve` 

---

# How to write and run TESTS on this Laravel App

# Laravel App including Eloquent Relationships TESTS and PHPUnit TESTS

### Laravel testing documentation

source : https://laravel.com/docs/12.x/testing

### How to use this repository
You do not need to (but you can) serve the app to run the tests, but you need a database to run this tests.
For this tests you can use MySQL or SQLite.
But if you use your existing populated database, be aware that the tests will empty your database and run all migrations again before running each test, because of using `use RefreshDatabase` in the test class.
So it is better to use a separate SQLite database for testing.
Therefore, you need to create an .env.testing, a separate connection in `config/database.php` and connect it in `phpunit.xml`.

The .env.testing will be used automatically when you run `php artisan test` or `vendor/bin/phpunit`.
The .env or .env.local will be used when you serve the app with `php artisan serve`.

### Use MySQL to serve the app
1. Copy and rename `.env.example` to `.env` or `.env.local` (the one you do not commit to git)
1b. configure APP_ENV=local
2. Generate an APP_KEY in it : `php artisan key:generate`
3. Create a new DB and name it 'project' in your database manager (phpmyadmin, wamp, etc...)
4. Configure your MySQL connection with this DB name in this .env file 
5. Run the migrations `php artisan migrate`.
6. Serve the app on localhost:8000 `php artisan serve`

### Use a testing env with SQLite to run the tests (in memory or on disk)
1. Copy and rename `.env.example` to `.env.testing`
2. configure APP_ENV=Testing in it
3. remove all DB_ entries from it
4. Generate app key : `php artisan key:generate --env=testing`
5. Add a connection in `config/database.php`
```
'sqlite' => [
            'driver' => 'sqlite',
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
        ],
```
And connect it in `phpunit.xml`
```
<env name="DB_CONNECTION" value="sqlite"/>
<env name="DB_DATABASE" value=":memory:"/>
```

To Run a single Test : `php artisan test --filter test_task_with_no_user` or `vendor/bin/phpunit --filter test_task_with_no_user`

To Run all Tests at once : `php artisan test` or `vendor/bin/phpunit`

Remind, BE CAREFULL !! the `use RefreshDatabase` instruction in `tests/Feature/RelationshipsTest.php` will empty the DB and run all migrations again before running each test.

Finally, run 
	php artisan optimize:clear
 to clear the caches if needed.

### You may encounter MySQL error key too long

Solution 1:

In file appServiceProvider.php in function boot() ->   Schema::defaultStringLength(191);

Solution 2:

Inside config/database.php, replace this line for mysql

```'engine' => null'```

with

```engine' => 'InnoDB ROW_FORMAT=DYNAMIC'```

Then retry    php artisan migrate:fresh




