# Liberfly

## Description

The project is an implementation of a RESTful API with PHP, Laravel and MySQL, it has JWT authentication.

## 👉 Requirements

1. PHP 8.2
2. Node 21
3. Composer
4. MySQL
5. Redis

## Documentation
[Here is the documentation.](http://localhost/api/documentation)
[But I prefer the Postman documentation!](https://documenter.getpostman.com/view/10880762/2sA3kd9cua)

## Kanban - Trello
https://trello.com/invite/b/66aa634d9af5a11fd3693155/ATTI07983eba7b16f77a5b66699b8a6ecee661E767CB/liberfly

## Installation

### Step 1: Clone the Repository

````
$ git clone git@github.com:andrersilva96/liberfly.git && cd liberfly
````

### Configure the Environment
Install PHP Dependencies

Make sure Composer is installed. Install project dependencies:

````
$ composer install
````

### Configure Database

In your .env from root at project configure the ``DB_*`` or the configurations that you want to make it run:

### Run the command bellow

```
    $ php artisan app:install
    $ php artisan jwt:secret
```
