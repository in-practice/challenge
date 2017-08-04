# Assumptions
1 - Sorting is allowed only for one field at a time.

2 - Date range should be provided both (checkin,checkout) or nothing

3 - All information is returned from the endpoint with no null values.


# Environment Prerequisites
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

# Running Unit Tests

1 - Run application unit tests using phpunit by executing the following command at the application root

```
./vendor/bin/phpunit
```

# Consuming API

You can consume the API using this shared postman collection

---
[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/4daead81b9acb081d9da)
---

Or using the following samples

1 - Basic Hotels Search

http://localhost:8000/api/hotels

2 - Hotel Name Search

http://localhost:8000/api/hotels?hotelName=Media

3 - City Search

http://localhost:8000/api/hotels?cityName=cairo

4 - Date Range Search

http://localhost:8000/api/hotels?fromDate=10-10-2020&toDate=11-10-2020

5 - Price Range Search

http://localhost:8000/api/hotels?fromPrice=100&toPrice=109.6

6 - All Combined

http://localhost:8000/api/hotels?hotelName=media&cityName=dubai&fromPrice=100&toPrice=109.6&fromDate=25-10-2020&toDate=14-11-2020