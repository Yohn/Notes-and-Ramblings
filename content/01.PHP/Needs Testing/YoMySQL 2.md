---
created: 2024-09-02T04:26:21-04:00
modified: 2024-09-02T04:26:21-04:00
---

To handle these scenarios where the variable before the deprecated function can take various forms, we need to enhance the `extractVariableName` method. This method will need to account for these different patterns, including array accesses and `$this->` references.

Here’s the updated `YoMySQL` class with the improved `extractVariableName` method:

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
		// Match variable assignment patterns before the function call
		if (preg_match('/(\$\w+(?:\[\'.+?\'\])*(?:\[\'.+?\'\])*)\s*=\s*' . preg_quote($function) . '/', $line, $matches)) {
			return $matches[1];
		}

		// Match $this->variable assignment patterns before the function call
		if (preg_match('/(\$this->\w+(?:\[\'.+?\'\])*(?:\[\'.+?\'\])*)\s*=\s*' . preg_quote($function) . '/', $line, $matches)) {
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

### Explanation of Updates:

1. **Enhanced `extractVariableName` Method:**
   - The method now uses regular expressions to match more complex variable names, including:
     - Simple variable assignments like `$var`.
     - Array accesses like `$var['ary']` and `$var['multi']['level']`.
     - `$this->` references like `$this->var` and `$this->var['ary']['level']`.
   - The regular expression checks for these patterns and extracts the full variable name before the deprecated function.

### Regular Expressions:

- **Simple Variables and Arrays:**
  - `(\$\w+(?:\[\'.+?\'\])*(?:\[\'.+?\'\])*)`: This matches variable names that may have multiple array accesses (e.g., `$var['ary']['level']`).
- **$this-> Variables and Arrays:**
  - `(\$this->\w+(?:\[\'.+?\'\])*(?:\[\'.+?\'\])*)`: This matches `$this->` variables that may also have multiple array accesses (e.g., `$this->var['ary']['level']`).

### Example Scenarios:

Given the scenarios you provided, the updated class should now be able to handle and correctly identify variable assignments such as:

- `$var = mysql_query(...);`
- `$var['ary'] = mysql_query(...);`
- `$var['multi']['level'] = mysql_query(...);`
- `$this->var = mysql_query(...);`
- `$this->var['ary'] = mysql_query(...);`
- `$this->var['ary']['level'] = mysql_query(...);`

These updates ensure that the class can accurately extract and record information about deprecated `mysql_*` function usage across a wide range of coding styles.

Feel free to test this updated version, and let me know if you need further adjustments!
