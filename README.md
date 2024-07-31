# plan_back

## Description

The project is an implementation of a RESTful API with PHP, Laravel and MySQL, it has JWT authentication.

## 👉 Requirements

1. PHP 8.2
2. Node 21
3. Composer
4. MySQL
5. Redis

## Documentation
Here is the  [documentation.](http://localhost/api/documentation)

But I prefer the [Postman](https://documenter.getpostman.com/view/10880762/2sA3kd9wnB) documentation!

## Kanban - Trello
https://trello.com/invite/b/66a42e5e84f44bd8fd878aba/ATTI4c6d9e11229b68c802fcbe1d0b6b2ee8CBD649B1/plan

## Installation

### Step 1: Clone the Repository

````
$ git clone git@github.com:andrersilva96/plan_back.git && cd plan_back
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
