---
created: 2024-09-02T04:26:25-04:00
modified: 2024-09-02T04:26:25-04:00
tags:
  - mysql
  - classes
  - deprecated
  - YoMySQL
---

To achieve this, we'll enhance the `YoMySQL` class by adding functionality to extract and store detailed information about each deprecated `mysql_*` function found in the PHP files. The information will be stored in an array within a class property, including the file path, variable name before the function, the function name, parameters, any code after the function call until the line ends, and the line numbers where the function is found.

Here’s the updated `YoMySQL` class:

### Updated `YoMySQL` Class

```php
<?php

class YoMySQL
{
	private array $deprecatedFunctions = [
		'mysql_connect',
		'mysql_pconnect',
		'mysql_select_db',
		'mysql_query',
		'mysql_unbuffered_query',
		'mysql_db_query',
		'mysql_list_dbs',
		'mysql_list_tables',
		'mysql_list_fields',
		'mysql_list_processes',
		'mysql_error',
		'mysql_errno',
		'mysql_affected_rows',
		'mysql_insert_id',
		'mysql_result',
		'mysql_fetch_row',
		'mysql_fetch_array',
		'mysql_fetch_assoc',
		'mysql_fetch_object',
		'mysql_data_seek',
		'mysql_fetch_lengths',
		'mysql_num_rows',
		'mysql_num_fields',
		'mysql_free_result',
		'mysql_field_seek',
		'mysql_field_name',
		'mysql_field_table',
		'mysql_field_len',
		'mysql_field_type',
		'mysql_field_flags',
		'mysql_escape_string',
		'mysql_real_escape_string',
		'mysql_stat',
		'mysql_thread_id',
		'mysql_client_encoding',
		'mysql_ping',
		'mysql_get_client_info',
		'mysql_get_host_info',
		'mysql_get_proto_info',
		'mysql_get_server_info',
		'mysql_info',
		'mysql_set_charset',
		'mysql',
		'mysql_fieldname',
		'mysql_fieldtable',
		'mysql_fieldlen',
		'mysql_fieldtype',
		'mysql_fieldflags',
		'mysql_selectdb',
		'mysql_createdb',
		'mysql_dropdb',
		'mysql_freeresult',
		'mysql_numfields',
		'mysql_numrows',
		'mysql_listdbs',
		'mysql_listtables',
		'mysql_listfields',
		'mysql_db_name',
		'mysql_dbname',
		'mysql_tablename',
		'mysql_table_name',
	];

	private array $foundDeprecatedFunctions = [];

	// Function to find all .php files in a directory
	public function findPHPFiles(string $directory): array
	{
		$phpFiles = [];

		// Recursively iterate through all files and directories
		$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

		foreach ($iterator as $file) {
			// Check if the file ends with .php
			if ($file->isFile() && $file->getExtension() === 'php') {
				$phpFiles[] = $file->getPathname();
			}
		}

		return $phpFiles;
	}

	// Function to search for deprecated mysql_* functions in a file
	public function findDeprecatedFunctions(string $filePath): void
	{
		// Read the file contents into an array of lines
		$lines = file($filePath);
		$inFunction = false;
		$currentFunctionData = [];

		// Iterate through each line in the file
		foreach ($lines as $lineNumber => $line) {
			foreach ($this->deprecatedFunctions as $function) {
				// Check if the line contains a deprecated function
				if (stripos($line, $function . '(') !== false || $inFunction) {
					if (!$inFunction) {
						$inFunction = true;
						$startLine = $lineNumber + 1;
						$variableName = $this->extractVariableName($line, $function);
						$parameters = $this->extractParameters($line, $function);
						$afterParameters = $this->extractAfterParameters($line);

						$currentFunctionData = [
							'filePath' => $filePath,
							'variableName' => $variableName,
							'functionName' => $function,
							'parameters' => $parameters,
							'afterParameters' => $afterParameters,
							'startLine' => $startLine,
						];
					}

					// Append lines to `afterParameters` until we reach the end of the statement
					if (strpos($line, ';') !== false) {
						$currentFunctionData['afterParameters'] .= trim($line);
						$currentFunctionData['endLine'] = $lineNumber + 1;
						$this->foundDeprecatedFunctions[] = $currentFunctionData;
						$inFunction = false;
					} else {
						$currentFunctionData['afterParameters'] .= trim($line);
					}

					break;
				}
			}
		}
	}

	// Function to extract the variable name before the deprecated function
	private function extractVariableName(string $line, string $function): ?string
	{
		// Match a variable assignment before the function call
		if (preg_match('/\$(\w+)\s*=\s*' . preg_quote($function) . '/', $line, $matches)) {
			return $matches[1];
		}
		return null;
	}

	// Function to extract the parameters passed to the deprecated function
	private function extractParameters(string $line, string $function): string
	{
		// Match everything between the parentheses
		if (preg_match('/' . preg_quote($function) . '\((.*?)\)/', $line, $matches)) {
			return $matches[1];
		}
		return '';
	}

	// Function to extract everything after the parameters until the semicolon
	private function extractAfterParameters(string $line): string
	{
		// Match everything after the closing parenthesis
		if (preg_match('/\)\s*(.*?);?$/', $line, $matches)) {
			return trim($matches[1]);
		}
		return '';
	}

	// Main function to process all .php files in a directory
	public function processDirectory(string $directory): void
	{
		$phpFiles = $this->findPHPFiles($directory);

		foreach ($phpFiles as $filePath) {
			$this->findDeprecatedFunctions($filePath);
		}
	}

	// Function to get the array of found deprecated functions
	public function getFoundDeprecatedFunctions(): array
	{
		return $this->foundDeprecatedFunctions;
	}
}

// Example usage:
$yoMySQL = new YoMySQL();
$yoMySQL->processDirectory('/path/to/your/php/files');

// Retrieve the array of deprecated function details
$foundFunctions = $yoMySQL->getFoundDeprecatedFunctions();
print_r($foundFunctions);
```

### Explanation:

1. **New Class Property:**

   - `foundDeprecatedFunctions`: An array that stores the detailed information about each deprecated function found.

2. **Enhanced Methods:**
   - **`findDeprecatedFunctions(string $filePath): void`:**
     - This method now reads the file line by line to extract and store detailed information for each deprecated function. It captures:
       - The file path (`filePath`).
       - The variable name before the deprecated function (if any) (`variableName`).
       - The deprecated function name (`functionName`).
       - The parameters passed to the function (`parameters`).
       - Everything after the function call until the semicolon (`afterParameters`).
       - The starting and ending line numbers of the deprecated function (`startLine`, `endLine`).
   - **`extractVariableName(string $line, string $function): ?string`:**
     - Extracts the variable name that might be assigned the result of the deprecated function.
   - **`extractParameters(string $line, string $function): string`:**
     - Extracts the parameters passed to the function.
   - **`extractAfterParameters(string $line): string`:**
     - Extracts everything after the parameters until the end of the line (or multi-line).
3. **Processing and Output:**
   - **`processDirectory(string $directory): void`:**
     - This method processes all PHP files in the specified directory, searching for deprecated functions and storing the results.
   - **`getFoundDeprecatedFunctions(): array`:**
     - Returns the array containing all the detailed information collected.

### Example Output:

Running the example usage might produce an output similar to:

```php
Array
(
	[0] => Array
		(
			[filePath] => /path/to/your/php/files/example.php
			[variableName] => result
			[functionName] => mysql_query
			[parameters] => "SELECT * FROM users WHERE id = $userId"
			[afterParameters] => or die('Error: ' . mysql_error());
			[startLine] => 10
			[endLine] => 10
		)
)
```

This output shows that the `mysql_query` function was found in `example.php`, starting and ending at line 10, with a variable `$result` assigned to it, and followed by an error handling expression `or die(...)`.

This setup will allow you to gather all necessary details
