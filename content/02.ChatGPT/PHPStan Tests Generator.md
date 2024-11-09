---
created: 2024-10-23T18:09:13-04:00
modified: 2024-10-24T12:56:00-04:00
tags:
  - php
  - tests
  - phpdoc
  - example-scripts
  - code-generator
  - test-units
  - class-generator
---

That’s a solid approach, Yohn! By embedding example usage in PHPDoc above your functions, we can then extract and convert those examples into automated tests. Here’s a practical way we can achieve this:

### 1. **Add Example Code in PHPDoc**

For each function or method, include an `@example` tag in the PHPDoc with the example code you’d want to use in your test cases. For instance:

```php
/**
 * Calculates the sum of two numbers.
 *
 * @param int $a The first number.
 * @param int $b The second number.
 * @return int The sum of $a and $b.
 *
 * @example
 * $result = $this->calculateSum(2, 3); // returns 5
 */
public function calculateSum(int $a, int $b): int {
	return $a + $b;
}
```

### 2. **Script to Extract Example Code**

Next, create a PHP script that scans your class files, extracts the `@example` blocks, and generates PHPStan or PHPUnit test methods for each one.

Here’s a simple version of how the extraction and generation might work:

```php
class TestGenerator {
	protected string $outputDir;

	public function __construct(string $outputDir) {
		$this->outputDir = $outputDir;
	}

	/**
	 * Scans the PHP class files and generates test files.
	 */
	public function generateTests(string $filePath): void {
		$contents = file_get_contents($filePath);
		$matches = [];

		// Match PHPDoc comments with @example
		preg_match_all('/@example\s+(.*)/', $contents, $matches);

		if (empty($matches[1])) {
			echo "No examples found in {$filePath}\n";
			return;
		}

		$testMethods = [];
		foreach ($matches[1] as $exampleCode) {
			$testMethods[] = $this->generateTestMethod($exampleCode);
		}

		$this->writeTestFile(basename($filePath), $testMethods);
	}

	/**
	 * Generates a single test method.
	 */
	protected function generateTestMethod(string $exampleCode): string {
		return <<<PHP
	public function testExample() {
		{$exampleCode}
		\$this->assertTrue(true); // Adjust assertion as needed
	}

PHP;
	}

	/**
	 * Writes the test file.
	 */
	protected function writeTestFile(string $className, array $testMethods): void {
		$testClass = str_replace('.php', 'Test.php', $className);
		$testFile = $this->outputDir . DIRECTORY_SEPARATOR . $testClass;

		$testContent = <<<PHP
<?php

use PHPUnit\Framework\TestCase;

class {$testClass} extends TestCase {
	{$testMethods}
}

PHP;

		file_put_contents($testFile, implode("\n", $testMethods));
		echo "Test generated: {$testFile}\n";
	}
}
```

### 3. **Run the Test Generator**

- Run this script to generate the PHPUnit tests.
- Ensure it points to your PHP files and extracts the `@example` blocks.

```php
$testGen = new TestGenerator('path/to/tests');
$testGen->generateTests('path/to/classes/MyClass.php');
```

### 4. **Extend for PHPStan**

If you want PHPStan tests, you can adjust the generated code to match PHPStan’s format, but the concept of extracting `@example` blocks remains the same. Since PHPStan works more on static analysis than runtime assertions, you would generate a `phpstan.neon` configuration or rule checks based on the examples.

---

This should give you a powerful tool to automate test generation while ensuring your example code is always reflected in tests. How does that approach look to you?
