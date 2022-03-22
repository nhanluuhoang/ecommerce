# PHP 7.4

## Project have start with docker
- First time installation:
    1. Replace name project in `docker-compose.yml`
    2. Replace name project in `nginx/conf.d/app.conf`
    ````
        {project} => real name project
    ````
- Start project with docker:
    ````
    make run
    ````
- Show command line make:
    ````
    make help
    ````

## Filter and Sort
````php
$query = new Query(Category::class);
$query = $query
    ->getColumn(['column1', 'column2', 'column3'])
    ->filterBy([
        'column1' => 'partial'
    ])
    ->customQuery([
        $query->getQuery()->where('column2', $value),
        $query->getQuery()->isPublic()
    ])
    ->sortFieldsBy(['column1', 'column2'])
    ->allowPaginate();

return $this->httpOK($query);
````

1. Function `getColumn`:
- Select column of table.
- Parameter is array
- Function is not required.
2. Function `filterBy`:
- Filter with attributes.
- Parameter is array.
  - Key: Attributes of model
  - Value: exact | partial | in | =
- Function is not required.
3. Function `customQuery`:
- Can call scope in model or query of builder.
- Parameter is array.
- Function is not required.
4. Function `sortFieldsBy`:
- Sort with attributes.
- Parameter is array.
- Function is not required.
5. Function `allowPaginate`:
- Pagination
- Params:
  - page[size]
  - page[number]


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
