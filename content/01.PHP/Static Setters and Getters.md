---
created: 2024-09-02T04:27:07-04:00
modified: 2024-09-05T22:23:09-04:00
tags:
  - php
  - __call
  - __callStatic
  - __get
  - __set
  - classes
  - magic-methods
  - static
---

In PHP, magic methods like `__get` and `__set` are inherently non-static, meaning they are designed to work with object instances rather than static context. However, if you want to create a system where a class property or method can be accessed both statically and non-statically, you can design your class to use a combination of static methods and regular instance methods.

Here's how you can approach this:

#### 1. **Creating Static and Non-Static Accessors**

You can create static and non-static versions of your getters and setters. This approach allows you to access properties in both contexts.

```php
class User {
    private static array $staticData = [];
    private array $instanceData = [];

    // Non-static magic method for instance properties
    public function __get(string $name) {
        return $this->instanceData[$name] ?? null;
    }

    public function __set(string $name, $value) {
        $this->instanceData[$name] = $value;
    }

    // Static methods for static properties
    public static function get(string $name) {
        return self::$staticData[$name] ?? null;
    }

    public static function set(string $name, $value) {
        self::$staticData[$name] = $value;
    }
}

$user = new User();
$user->name = "John Doe";        // Uses __set
echo $user->name;                // Uses __get

User::set('globalName', "Jane Doe"); // Static set
echo User::get('globalName');        // Static get
```

#### 2. **Creating a Unified Interface for Both Static and Non-Static Access**

If you want a more unified approach where a single method can handle both static and non-static access, you can use PHP’s `__callStatic` magic method alongside `__call` for instance methods.

Here's how you could implement this:

```php
class UniversalAccessor {
    private static array $staticData = [];
    private array $instanceData = [];

    // Handle non-static method calls
    public function __call(string $name, array $arguments) {
        if ($name === 'get') {
            return $this->instanceData[$arguments[0]] ?? null;
        } elseif ($name === 'set') {
            $this->instanceData[$arguments[0]] = $arguments[1];
            return $this;
        }
    }

    // Handle static method calls
    public static function __callStatic(string $name, array $arguments) {
        if ($name === 'get') {
            return self::$staticData[$arguments[0]] ?? null;
        } elseif ($name === 'set') {
            self::$staticData[$arguments[0]] = $arguments[1];
            return new static(); // Return an instance to allow chaining if needed
        }
    }
}

$instance = new UniversalAccessor();
$instance->set('name', 'John Doe');   // Uses __call
echo $instance->get('name');          // Uses __call

UniversalAccessor::set('globalName', 'Jane Doe'); // Uses __callStatic
echo UniversalAccessor::get('globalName');        // Uses __callStatic
```

#### 3. **Best Practices**

- **Use Static Methods for Global State**: Static methods should typically be used when you want to manage a shared state across all instances or when dealing with class-wide settings.
- **Avoid Overcomplicating**: Combining static and non-static methods into a single interface can be powerful but might lead to code that’s harder to maintain. Use this approach only when there is a clear need to unify the interface.

- **Document Your Code**: If you’re mixing static and non-static methods, make sure to document how and why they’re used, to avoid confusion for future maintainers.

### Summary

- **Magic Methods**: `__get` and `__set` are inherently non-static. To handle static scenarios, you should use regular static methods.
- **Unified Interface**: You can create a class with both `__call` and `__callStatic` methods to provide a unified interface for static and non-static property access.
- **Static Context**: Remember that static methods can’t access instance-specific properties, so separate storage or handling is needed.

This approach provides flexibility in how you design your classes, allowing for both instance-specific and class-wide property access in a consistent manner.
