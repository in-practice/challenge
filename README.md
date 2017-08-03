# Assumptions
1 - Sorting is allowed only for one field at a time.
2 - Price range should be provided both (min,max) or nothing
3 - Date range should be provided both (checkin,checkout) or nothing
4 - All information is returned from the endpoint with no null values.

#Environment Prerequisites
1 - PHP 7.1 or later
2 - Composer

# Running The Application
1 - Installing composer packages running the following command at the application root
```
composer install
```

2 - Running the application using the following artisan command
```
php artisan serve
```
by default ,the application will be served using laravel development server on port 8000

#Running Unit Tests
1 - Run application unit tests using phpunit by executing the following command at the application root
```
./vendor/bin/phpunit
```