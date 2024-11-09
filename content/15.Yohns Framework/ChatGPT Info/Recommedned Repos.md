---
created: 2024-10-20T03:28:57-04:00
modified: 2024-10-20T04:26:10-04:00
---

When building a lightweight PHP web app without a framework, you can leverage a few key Composer packages to help with routing, dependency injection, templating, and other common tasks. Here's a list of popular, lightweight, and actively maintained Composer packages you might consider:

### 1. **Routing**

- **[nikic/FastRoute](https://github.com/nikic/FastRoute)**  
  A fast, simple routing library. It doesn't come with unnecessary features, making it perfect for a lightweight app.

  ```bash
  composer require nikic/fast-route
  ```

### 2. **HTTP Message (PSR-7)**

- **[nyholm/psr7](https://github.com/Nyholm/psr7)**  
  A super lightweight and efficient PSR-7 implementation for handling HTTP requests and responses.

  ```bash
  composer require nyholm/psr7
  ```

### 3. **Dependency Injection**

- **[php-di/php-di](https://github.com/PHP-DI/PHP-DI)**  
  A dependency injection container that adheres to PSR-11. It's lightweight and flexible.

  ```bash
  composer require php-di/php-di
  ```

### 4. **Templating Engine**

- **[twig/twig](https://github.com/twigphp/Twig)**  
  A fast and flexible templating engine, although somewhat heavier compared to others, it's still popular and well-supported. For a more lightweight alternative, you could consider **Plates**.

  ```bash
  composer require twig/twig
  ```

  Or if you prefer a lightweight alternative:

  - **[league/plates](https://github.com/thephpleague/plates)**

  ```bash
  composer require league/plates
  ```

### 5. **HTTP Abstraction (PSR-17, PSR-18)**

- **[guzzlehttp/guzzle](https://github.com/guzzle/guzzle)**  
  A simple and widely used HTTP client for sending HTTP requests.

  ```bash
  composer require guzzlehttp/guzzle
  ```

  If you want a more lightweight PSR-compliant HTTP client, consider **[kriswallsmith/buzz](https://github.com/kriswallsmith/Buzz)**.

### 6. **Dotenv (Environment Variables)**

- **[vlucas/phpdotenv](https://github.com/vlucas/phpdotenv)**  
  Loads environment variables from a `.env` file, keeping configuration outside your codebase.

  ```bash
  composer require vlucas/phpdotenv
  ```

### 7. **Error Handling**

- **[filp/whoops](https://github.com/filp/whoops)**  
  A user-friendly error handling library that displays detailed error information.

  ```bash
  composer require filp/whoops
  ```

### 8. **Logging**

- **[monolog/monolog](https://github.com/Seldaek/monolog)**  
  A popular logging library that implements the PSR-3 interface. It's highly configurable and suitable for any project size.

  ```bash
  composer require monolog/monolog
  ```

### 9. **Database**

- **[doctrine/dbal](https://github.com/doctrine/dbal)**  
  A lightweight abstraction layer for interacting with databases. If you don't want a full ORM, DBAL is a good choice.

  ```bash
  composer require doctrine/dbal
  ```

For lightweight ORM alternatives, consider **[illuminate/database](https://github.com/illuminate/database)** (from Laravel's components), which can be used standalone:

```bash
composer require illuminate/database
```

### Summary of Composer Requirements:

```bash
composer require nikic/fast-route nyholm/psr7 php-di/php-di twig/twig guzzlehttp/guzzle vlucas/phpdotenv filp/whoops monolog/monolog doctrine/dbal
```

These packages are all widely used and actively maintained, ensuring long-term support and a stable codebase for your web app.
