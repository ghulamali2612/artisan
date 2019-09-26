# Artisan
Laravel basic artisan commands

### Installation
Use Composer to install the library.
```
$ composer require ghulamali2612/artisan
```
<br/>

### Implementation
*Add this line in config/app.php*
```
GhulamAli\Artisan\ArtisanServiceProvider::class
```

<br/>

### Usage

- $ php artisan artisan-database:tables //List of your database table
- $ php artisan artisan-database:refresh //Truncate all database tables except migration
- $ php artisan artisan-database:truncate table_name //Truncate requested table only
- $ php artisan artisan-database:drop table_name //Drop the requested table
- $ php artisan artisan-log:clear //Clear storage/logs/laravel.log file
