---
created: 2024-09-05T04:02:52-04:00
modified: 2024-09-05T04:16:25-04:00
tags:
  - laravel
  - laravel11
  - route
  - routing
  - api
  - methods
  - dependency-injection
  - CSFR
  - security
  - protection
  - form-protection
  - token
---

> [!info]+ Laravel 11.x Docs
> This was copied from [Larvel Docs -> Route Groups](https://laravel.com/docs/11.x/routing#route-groups)

### [The Default Route Files](https://laravel.com/docs/11.x/routing#the-default-route-files)

All Laravel routes are defined in your route files, which are located in the `routes` directory. These files are automatically loaded by Laravel using the configuration specified in your application's `bootstrap/app.php` file. The `routes/web.php` file defines routes that are for your web interface. These routes are assigned the `web` [middleware group](https://laravel.com/docs/11.x/middleware#laravels-default-middleware-groups), which provides features like session state and CSRF protection.

For most applications, you will begin by defining routes in your `routes/web.php` file. The routes defined in `routes/web.php` may be accessed by entering the defined route's URL in your browser. For example, you may access the following route by navigating to `http://example.com/user` in your browser:

```php
use App\Http\Controllers\UserController; 
Route::get('/user', [UserController::class, 'index']);
```

#### [API Routes](https://laravel.com/docs/11.x/routing#api-routes)

If your application will also offer a stateless API, you may enable API routing using the `install:api` Artisan command:

```
php artisan install:api
```

The `install:api` command installs [Laravel Sanctum](https://laravel.com/docs/11.x/sanctum), which provides a robust, yet simple API token authentication guard which can be used to authenticate third-party API consumers, SPAs, or mobile applications. In addition, the `install:api` command creates the `routes/api.php` file:

```php
Route::get('/user', function (Request $request) {
	return $request->user();
})->middleware('auth:sanctum');
```

The routes in `routes/api.php` are stateless and are assigned to the `api` [middleware group](https://laravel.com/docs/11.x/middleware#laravels-default-middleware-groups). Additionally, the `/api` URI prefix is automatically applied to these routes, so you do not need to manually apply it to every route in the file. You may change the prefix by modifying your application's `bootstrap/app.php` file:

```php
->withRouting(
	api: __DIR__.'/../routes/api.php',
	apiPrefix: 'api/admin',
	// ...
)
```

#### [Available Router Methods](https://laravel.com/docs/11.x/routing#available-router-methods)

The router allows you to register routes that respond to any HTTP verb:

```php
Route::get($uri, $callback);
Route::post($uri, $callback);
Route::put($uri, $callback);
Route::patch($uri, $callback);
Route::delete($uri, $callback);
Route::options($uri, $callback);
```

Sometimes you may need to register a route that responds to multiple HTTP verbs. You may do so using the `match` method. Or, you may even register a route that responds to all HTTP verbs using the `any` method:

```php
Route::match(['get', 'post'], '/', function () {
	// ...
});
Route::any('/', function () {
	// ...
});
```

When defining multiple routes that share the same URI, routes using the `get`, `post`, `put`, `patch`, `delete`, and `options` methods should be defined before routes using the `any`, `match`, and `redirect` methods. This ensures the incoming request is matched with the correct route.

#### [Dependency Injection](https://laravel.com/docs/11.x/routing#dependency-injection)

You may type-hint any dependencies required by your route in your route's callback signature. The declared dependencies will automatically be resolved and injected into the callback by the Laravel [service container](https://laravel.com/docs/11.x/container). For example, you may type-hint the `Illuminate\Http\Request` class to have the current HTTP request automatically injected into your route callback:

```php
use Illuminate\Http\Request; 
Route::get('/users', function (Request $request) {
	// ...
});
```

#### [CSRF Protection](https://laravel.com/docs/11.x/routing#csrf-protection)

Remember, any HTML forms pointing to `POST`, `PUT`, `PATCH`, or `DELETE` routes that are defined in the `web` routes file should include a CSRF token field. Otherwise, the request will be rejected. You can read more about CSRF protection in the [CSRF documentation](https://laravel.com/docs/11.x/csrf):

```html
<form method="POST" action="/profile">@csrf ...</form>
```
