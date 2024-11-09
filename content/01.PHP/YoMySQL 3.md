---
created: 2024-09-02T04:26:18-04:00
modified: 2024-11-07T22:43:39-05:00
tags:
  - mysql
  - YoMySQL
  - sqlrefactor
---

To accurately capture the parameters of the `mysql_query` (or any other deprecated `mysql_*` function) that may contain nested functions, subqueries, or even complex expressions, we need to enhance the parameter extraction logic to correctly identify the start and end of the parameter list. This involves properly parsing nested parentheses and ensuring that we capture the entire expression.

Here's how you can update the `YoMySQL` class to handle this:

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

	// Function to extract everything after the parameters until the semicolon
	private function extractAfterParameters(string $line, string $parameters): string
	{
		// Find the portion of the line after the parameters
		$positionAfterParams = strpos($line, $parameters) + strlen($parameters) + 1; // +1 for the closing parenthesis
		$afterParameters = substr($line, $positionAfterParams);

		return trim($afterParameters);
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

1. **Enhanced `extractParameters` Method:**

   - This method now accounts for nested functions and subqueries within the parameters of the `mysql_*` functions.
   - The method tracks the number of open and close parentheses to ensure it captures the entire parameter expression, even if it spans multiple lines or contains nested parentheses.

2. **Parameter Parsing Logic:**

   - The method begins capturing the parameters from the first `(` it encounters after the function name.
   - It continues to append lines until the number of opening and closing parentheses match, ensuring all nested functions or expressions are included.
   - The parameters are then cleaned to remove any content beyond the closing parenthesis.

3. **Handling Complex Scenarios:**
   - This logic ensures that parameters like the following are captured correctly:
     ```php
     $result = mysql_query("SELECT * FROM users WHERE id = (SELECT user_id FROM orders WHERE order_id = $orderId) AND status = 'active'");
     ```
   - The above would capture the entire query, including the nested subquery.

### Testing:

You can run the updated class against your PHP files to ensure it correctly identifies and captures complex `mysql_*` function calls. This should now handle scenarios where the parameters contain nested functions, subqueries, or span multiple lines.

Let me know if you need further adjustments or if there are additional cases you'd like to cover!
