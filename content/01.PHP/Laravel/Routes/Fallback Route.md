---
created: 2024-09-05T03:58:51-04:00
modified: 2024-09-05T22:38:45-04:00
tags:
  - laravel
  - route
  - routing
  - fallback
  - laravel11
---

> [!info]+ Laravel 11.x Docs
> This was copied from [Larvel Docs -> Route Groups](https://laravel.com/docs/11.x/routing#route-groups)

## [Fallback Routes](https://laravel.com/docs/11.x/routing#fallback-routes)

Using the `Route::fallback` method, you may define a route that will be executed when no other route matches the incoming request. Typically, unhandled requests will automatically render a "404" page via your application's exception handler. However, since you would typically define the `fallback` route within your `routes/web.php` file, all middleware in the `web` middleware group will apply to the route. You are free to add additional middleware to this route as needed:

```php
Route::fallback(function () {
	// ...
});
```
