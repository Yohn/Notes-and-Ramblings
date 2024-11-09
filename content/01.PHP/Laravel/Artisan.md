---
created: 2024-09-05T22:23:12-04:00
modified: 2024-09-06T01:16:21-04:00
tags:
  - laravel
  - cheat sheet
  - beginning
  - help
  - artisan
  - how-to
  - routes
  - optimize
  - config
  - cache
---

# Artisan

- [Database](#Database)
- [Config](#Config)
- [Route](#Route)
- [Optimize](#Optimize)

```sh
php artisan key:generate
php artisan server
```

## Database

```sh
php artisan migrate
php artisan db:seed
```

Below are some helpful Artisan CLI commands to speed up the overall development process:

## Config

```sh
php artisan config: clear
```

```sh
php artisan config: cache
```

##### This command limits the IO request and makes loading faster by combining all configuration options for your application into a single file

## Route

```sh
php artisan route:list
php artisan route: clear
```

```sh
php artisan route: cache
```

##### This command reduces the overall computation time. Don’t use it if you have closure-based routes

## Optimize

```sh
php artisan optimize
```

##### This command compiles all your views and optimizes the autoloader
