# PHP 7.4

## Installation

````
$ composer install
````

## Create .env file
```
$ cp .env.example .env 
```

## Create Secret Key
````
$ php artisan key:generate

$ php artisan passport:keys
$ php artisan passport:client --personal
````

## Seed database
````
$ php artisan migrate:refresh --seed
$ php artisan queue:table
$ php artisan migrate
````

## Start schedule
````
$ php artisan schedule:work
````

## Start queue
````
$ php artisan queue:work
````
