---
created: 2024-09-02T04:27:06-04:00
modified: 2024-09-05T22:00:31-04:00
tags:
  - php
  - classes
  - magic-methods
  - __set
  - __get
  - __call
  - __callStatic
  - __toString
  - __invoke
  - __clone
  - __sleep
  - __wakeup
  - __serialize
  - __unserialize
  - __debugInfo
  - __destruct
  - __construct
---

> [!note] Info
> In PHP, magic methods are special methods that start with a double underscore (`__`). These methods are automatically called in certain situations and allow you to define custom behavior for operations like object instantiation, method calls, property access, and more. Below is a list of common magic methods in PHP, along with explanations and examples.

### 1. **`__construct`**

- **Purpose**: Called when a new object is created. It's the constructor method where you can initialize object properties or execute any setup code.
- **Example**:

  ```php
  class User {
      public function __construct(private string $name) {
          // Initialize the object
          echo "User created: " . $this->name;
      }
  }

  $user = new User("John Doe"); // Outputs: User created: John Doe
  ```

### 2. **`__destruct`**

- **Purpose**: Called when an object is destroyed (e.g., when it goes out of scope or the script ends). It’s often used for cleanup tasks, like closing database connections.
- **Example**:

  ```php
  class User {
      public function __destruct() {
          echo "User destroyed.";
      }
  }

  $user = new User("John Doe");
  unset($user); // Explicitly destroys the object, Outputs: User destroyed.
  ```

### 3. **`__call`**

- **Purpose**: Invoked when calling a non-existing or inaccessible method on an object. This method allows you to define custom behavior for such method calls.
- **Example**:

  ```php
  class DynamicMethods {
      public function __call($name, $arguments) {
          echo "Call to method $name with arguments: " . implode(', ', $arguments);
      }
  }

  $obj = new DynamicMethods();
  $obj->nonExistentMethod('arg1', 'arg2'); // Outputs: Call to method nonExistentMethod with arguments: arg1, arg2
  ```

### 4. **`__callStatic`**

- **Purpose**: Similar to `__call`, but used for static method calls on non-existing or inaccessible methods.
- **Example**:

  ```php
  class StaticMethods {
      public static function __callStatic($name, $arguments) {
          echo "Static call to method $name with arguments: " . implode(', ', $arguments);
      }
  }

  StaticMethods::nonExistentStaticMethod('arg1', 'arg2'); // Outputs: Static call to method nonExistentStaticMethod with arguments: arg1, arg2
  ```

### 5. **`__get`**

- **Purpose**: Invoked when accessing a non-existing or inaccessible property. Allows you to define custom behavior for property retrieval.
- **Example**:

  ```php
  class DynamicProperties {
      private $properties = [];

      public function __get($name) {
          return $this->properties[$name] ?? "Property $name does not exist.";
      }

      public function __set($name, $value) {
          $this->properties[$name] = $value;
      }
  }

  $obj = new DynamicProperties();
  $obj->name = "John Doe";
  echo $obj->name; // Outputs: John Doe
  echo $obj->nonExistentProperty; // Outputs: Property nonExistentProperty does not exist.
  ```

### 6. **`__set`**

- **Purpose**: Invoked when assigning a value to a non-existing or inaccessible property. It allows you to define custom behavior for property assignment.
- **Example**:

  ```php
  class DynamicProperties {
      private $properties = [];

      public function __get($name) {
          return $this->properties[$name] ?? null;
      }

      public function __set($name, $value) {
          $this->properties[$name] = $value;
      }
  }

  $obj = new DynamicProperties();
  $obj->name = "John Doe";
  echo $obj->name; // Outputs: John Doe
  ```

### 7. **`__isset`**

- **Purpose**: Invoked when calling `isset()` or `empty()` on a non-existing or inaccessible property. It allows you to define custom behavior for checking property existence.
- **Example**:

  ```php
  class DynamicProperties {
      private $properties = [];

      public function __isset($name) {
          return isset($this->properties[$name]);
      }

      public function __set($name, $value) {
          $this->properties[$name] = $value;
      }
  }

  $obj = new DynamicProperties();
  $obj->name = "John Doe";
  var_dump(isset($obj->name)); // Outputs: bool(true)
  var_dump(isset($obj->nonExistentProperty)); // Outputs: bool(false)
  ```

### 8. **`__unset`**

- **Purpose**: Invoked when `unset()` is called on a non-existing or inaccessible property. It allows you to define custom behavior for property unsetting.
- **Example**:

  ```php
  class DynamicProperties {
      private $properties = [];

      public function __unset($name) {
          unset($this->properties[$name]);
      }

      public function __set($name, $value) {
          $this->properties[$name] = $value;
      }
  }

  $obj = new DynamicProperties();
  $obj->name = "John Doe";
  unset($obj->name);
  var_dump(isset($obj->name)); // Outputs: bool(false)
  ```

### 9. **`__toString`**

- **Purpose**: Invoked when an object is treated as a string, such as when you try to `echo` an object. This method must return a string.
- **Example**:

  ```php
  class User {
      private $name;

      public function __construct($name) {
          $this->name = $name;
      }

      public function __toString() {
          return $this->name;
      }
  }

  $user = new User("John Doe");
  echo $user; // Outputs: John Doe
  ```

### 10. **`__invoke`**

- **Purpose**: Invoked when an object is called as a function. This allows objects to be used in a function-like manner.
- **Example**:

  ```php
  class CallableClass {
      public function __invoke($arg) {
          return "Called with argument: $arg";
      }
  }

  $obj = new CallableClass();
  echo $obj("some argument"); // Outputs: Called with argument: some argument
  ```

### 11. **`__clone`**

- **Purpose**: Invoked when an object is cloned using the `clone` keyword. This method allows you to define custom behavior during the cloning process, such as deep copying.
- **Example**:

  ```php
  class User {
      public $name;

      public function __clone() {
          $this->name = "Clone of " . $this->name;
      }
  }

  $user = new User();
  $user->name = "John Doe";
  $clonedUser = clone $user;
  echo $clonedUser->name; // Outputs: Clone of John Doe
  ```

### 12. **`__sleep` and `__wakeup`**

- **Purpose**: `__sleep` is called before an object is serialized with `serialize()`, allowing you to define which properties should be serialized. `__wakeup` is called when an object is unserialized with `unserialize()`, allowing you to reinitialize the object if necessary.
- **Example**:

  ```php
  class User {
      private $name;
      private $password;

      public function __construct($name, $password) {
          $this->name = $name;
          $this->password = $password;
      }

      public function __sleep() {
          // Only serialize the name, not the password
          return ['name'];
      }

      public function __wakeup() {
          // Reinitialize after unserialization
          $this->password = 'default_password';
      }
  }

  $user = new User("John Doe", "secret");
  $serialized = serialize($user);
  $unserializedUser = unserialize($serialized);
  ```

### 13. **`__debugInfo`**

- **Purpose**: Invoked when `var_dump()` is called on an object. This method allows you to control what information is displayed.
- **Example**:

  ```php
  class User {
      private $name;
      private $password;

      public function __construct($name, $password) {
          $this->name = $name;
          $this->password = $password;
      }

      public function __debugInfo() {
          return [
              'name' => $this->name,
              // Exclude the password from being dumped
          ];
      }
  }

  $user = new User("John Doe", "secret");
  var_dump($user); // Outputs: array(1) { ["name"]=> string(8) "John Doe" }
  ```

### 14. **`__serialize` and `__unserialize`** (PHP 7.4+)

- **Purpose**: These methods allow you to define custom serialization and unserialization behavior in a more controlled and type-safe manner than `__sleep` and `__wakeup`.
- **Example**:

  ```php
  class User {
      private string $name;
      private string $email;

      public function __construct(string $name, string $email) {
          $this->name = $name;
          $this->email = $email;
      }

      public function __serialize(): array {
          return [
              'name' => $this->name,
              'email' => $this->email,
          ];
      }

      public function __unserialize(array $data): void {
          $this->name = $data['name'];
          $this->email = $data['email'];
      }
  }

  $user = new User('John Doe', 'john@example.com');
  $serialized = serialize($user);
  $unserializedUser = unserialize($serialized);
  ```

### Summary

Magic methods in PHP provide powerful ways to customize and extend the behavior of objects in various contexts. By implementing these methods, you can:

- Control how properties and methods are accessed and modified.
- Customize object serialization and cloning.
- Define behavior for when an object is treated as a string, function, or debugged.

When using magic methods, it's essential to follow best practices:

- **Use Magic Methods Wisely**: Overuse can lead to confusing or hard-to-debug code, as the behavior may not be immediately apparent.
- **Document Their Usage**: Ensure that the custom behavior introduced by magic methods is well-documented, so others (or your future self) understand how the class behaves.

By understanding and leveraging magic methods, you can create more flexible, dynamic, and powerful PHP applications.
