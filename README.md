[Laravel-Tailwind](https://gitlab.com/mathiasappelmans/laravel-tailwind)

## This is a nice ready-to-use Laravel Tailwind e-commerce app.

### Laravel topics included:

- routes
- views 
- controllers
- models (factories, seeders)
- database multi-connections
- tests phpunit and features tests

### Demo

* Configure your .env file database connection
    * for SQLite, your system need php SQLite installation
    [https://doc.dotdev.be/sql/sqlite](https://doc.dotdev.be/sql/sqlite)
    ```
    Activate extension=pdo_sqlite in php.ini
    ```
    Create your DB file or copy paste an existing sqlite file from anywhere
    ```
    touch database/database.sqlite
    ```
* Generate your APP_KEY
```
php artisan key:generate
```
- run `composer install` // vendor dependencies (composer.json)
- run `npm install && npm run dev` // node_modules default frontend dependencies (package.json)
- run `php artisan migrate --seed`
- run `php artisan serve`


