---
created: 2024-09-02T04:26:14-04:00
modified: 2024-11-07T22:43:37-05:00
tags:
  - mysql
  - YoMySQL
  - sqlrefactor
---

Here's the `YoMySQL` class with added PHPDoc comments for each method and property:
neews testing

### Updated `YoMySQL` Class with PHPDoc Comments

```php
<?php

class YoMySQL
{
	/**
	 * @var array List of deprecated mysql_* functions.
	 */
	private array $deprecatedFunctions = [
		// List of all deprecated mysql_* functions
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

	/**
	 * @var array List of found deprecated mysql_* functions with details.
	 */
	private array $foundDeprecatedFunctions = [];

	/**
	 * Find all .php files in a directory.
	 *
	 * @param string $directory The directory to search.
	 * @return array The list of .php files found.
	 */
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

	/**
	 * Search for deprecated mysql_* functions in a file.
	 *
	 * @param string $filePath The path to the file being analyzed.
	 * @return void
	 */
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
						$parameters = $this->extractParameters($lines, $lineNumber, $function);
						$afterParameters = $this->extractAfterParameters($line, $parameters);

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

	/**
	 * Extract the variable name before the deprecated function.
	 *
	 * @param string $line The line of code containing the function.
	 * @param string $function The deprecated function name.
	 * @return string|null The extracted variable name, or null if not found.
	 */
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

	/**
	 * Extract the parameters passed to the deprecated function.
	 *
	 * @param array $lines The lines of code from the file.
	 * @param int $startLine The starting line number for the search.
	 * @param string $function The deprecated function name.
	 * @return string The extracted parameters.
	 */
	private function extractParameters(array $lines, int $startLine, string $function): string
	{
		$parameters = '';
		$openParentheses = 0;
		$closeParentheses = 0;
		$inParameters = false;

		// Start parsing from the line containing the function
		for ($i = $startLine; $i < count($lines); $i++) {
			$line = $lines[$i];

			// Start capturing parameters after encountering the first '('
			if (!$inParameters && strpos($line, $function . '(') !== false) {
				$inParameters = true;
				$line = substr($line, strpos($line, $function . '(') + strlen($function));
			}

			// Count open and close parentheses to track nested functions
			$openParentheses += substr_count($line, '(');
			$closeParentheses += substr_count($line, ')');

			$parameters .= trim($line);

			// Stop when all opened parentheses have been closed
			if ($inParameters && $openParentheses === $closeParentheses) {
				break;
			}
		}

		// Clean the parameters to remove any extra content after the closing parenthesis
		$parameters = substr($parameters, strpos($parameters, '(') + 1);
		$parameters = rtrim(substr($parameters, 0, strrpos($parameters, ')')));

		return $parameters;
	}

	/**
	 * Extract everything after the parameters until the semicolon.
	 *
	 * @param string $line The line of code containing the function.
	 * @param string $parameters The parameters of the function.
	 * @return string The extracted content after the parameters.
	 */
	private function extractAfterParameters(string $line, string $parameters): string
	{
		// Find the portion of the line after the parameters
		$positionAfterParams = strpos($line, $parameters) + strlen($parameters) + 1; // +1 for the closing parenthesis
		$afterParameters = substr($line, $positionAfterParams);

		return trim($afterParameters);
	}

	/**
	 * Process all .php files in a directory to find deprecated functions.
	 *
	 * @param string $directory The directory to process.
	 * @return void
	 */
	public function processDirectory(string $directory): void
	{
		$phpFiles = $this->findPHPFiles($directory);

		foreach ($phpFiles as $filePath) {
			$this->findDeprecatedFunctions($filePath);
		}
	}

	/**
	 * Get the array of found deprecated functions.
	 *
	 * @return array The array containing details of found deprecated functions.
	 */
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

### PHPDoc Comments Overview:

1. **Class Properties:**

   - Each property has a `@var` annotation explaining its type and purpose.
   - `deprecatedFunctions`: List of deprecated `mysql_*` functions.
   - `foundDeprecatedFunctions`: Stores the details of found deprecated functions.

2. **Methods:**
   - Each method has a `@param` annotation for input parameters, specifying the type and purpose of each parameter.
   - Each method also has a `@return` annotation specifying the return type and what the method returns.
   - `findPHPFiles`: Finds all `.php` files in the given directory.
   - `findDeprecatedFunctions`: Searches a file for deprecated `mysql_*` functions and stores details.
   - `extractVariableName`: Extracts the variable name before the deprecated function.
   - `extractParameters`: Extracts the parameters passed to the deprecated function, handling nested functions and subqueries.
   - `extractAfterParameters`: Extracts content after the parameters until the end of the line.
   - `processDirectory`: Processes all `.php` files in the directory to find deprecated functions.
   - `getFoundDeprecatedFunctions`: Returns the array of found deprecated functions with details.

These comments will help improve the readability and maintainability of your code, making it easier for others (and future you) to understand the purpose and functionality of each part of the `YoMySQL` class. Let me know if there are any other enhancements you'd like!
