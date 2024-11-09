---
created: 2024-10-24T21:03:37-04:00
modified: 2024-10-24T21:04:59-04:00
tags:
  - plugins
  - plugable
  - yohns
  - my-scripts
  - Events
  - hooks
  - filters
---

Here are some examples of how to use the `Plugable` class from the `Yohns\Utils` namespace. This class is designed to handle plugins, hooks, and filters. The examples below demonstrate how to load plugins, add hooks, trigger those hooks, add filters, and apply them.

### Example 1: Loading Plugins

This example loads plugins from the directory specified in your configuration file.

```php
use Yohns\Utils\Plugable;

// Define an array of plugin names to load
$plugins = ['pluginA', 'pluginB'];

// Load the plugins
$loadedPlugins = Plugable::loadPlugins($plugins);

// Check the loaded plugins
print_r($loadedPlugins);
```

### Example 2: Adding Hooks

Hooks allow you to attach functions to specific events. Here’s how you can add a single hook and multiple hooks.

#### Add a Single Hook

```php
use Yohns\Utils\Plugable;

// Define a simple function to be triggered by the hook
function exampleHook($args) {
	echo "Hook triggered with arguments: " . implode(', ', $args);
}

// Add the hook for a specific event
Plugable::addHook('my_event', 'exampleHook');
```

#### Add Multiple Hooks

```php
use Yohns\Utils\Plugable;

// Define functions for different events
function hookOne($args) {
	echo "First hook triggered with: " . implode(', ', $args);
}

function hookTwo($args) {
	echo "Second hook triggered with: " . implode(', ', $args);
}

// Add multiple hooks at once
Plugable::addHooks([
	'event_one' => 'hookOne',
	'event_two' => 'hookTwo',
]);
```

### Example 3: Triggering a Hook

After registering hooks, you can trigger them using the `doHook()` method. This method calls all attached functions for the given event and passes any arguments to them.

```php
use Yohns\Utils\Plugable;

// Trigger the hook 'my_event' with some arguments
Plugable::doHook('my_event', 'arg1', 'arg2');
```

### Example 4: Removing a Hook

To remove a function from an event's hook, use `removeHook()`.

```php
use Yohns\Utils\Plugable;

// Remove the 'exampleHook' from 'my_event'
Plugable::removeHook('my_event', 'exampleHook');
```

### Example 5: Adding Filters

Filters modify data before it is processed. You can add a filter using `addFilter()`.

```php
use Yohns\Utils\Plugable;

// Add a filter for an event
Plugable::addFilter('my_filter_event', ['key' => 'value']);
```

### Example 6: Applying Filters

After adding a filter, you can apply it using `doFilter()`, which will modify the data using the specified callback function.

```php
use Yohns\Utils\Plugable;

// Define a filter function that modifies the data
function modifyFilter($data) {
	// Example: Append a new value to the existing data array
	$data[] = ['new_key' => 'new_value'];
	return $data;
}

// Apply the filter to 'my_filter_event'
$filteredData = Plugable::doFilter('my_filter_event', 'modifyFilter');

// Output the filtered data
print_r($filteredData);
```

These examples cover the main functionality of the `Plugable` class. You can load plugins, register hooks and filters, trigger events, and manipulate data efficiently using this class.
