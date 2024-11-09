---
created: 2024-10-27T04:44:57-04:00
modified: 2024-11-07T22:41:55-05:00
tags:
  - php
  - functions
  - sprintf
  - find-replace
  - strict-replace
  - str_replace
  - replace-alternative
---

## PHP Website

**Specifiers**

| Specifier | Description                                                                                                                                                                                                                                                                                                                               |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `%`       | A literal percent character. No argument is required.                                                                                                                                                                                                                                                                                     |
| `b`       | The argument is treated as an integer and presented as a binary number.                                                                                                                                                                                                                                                                   |
| `c`       | The argument is treated as an integer and presented as the character with that ASCII.                                                                                                                                                                                                                                                     |
| `d`       | The argument is treated as an integer and presented as a (signed) decimal number.                                                                                                                                                                                                                                                         |
| `e`       | The argument is treated as scientific notation (e.g. 1.2e+2).                                                                                                                                                                                                                                                                             |
| `E`       | Like the `e` specifier but uses uppercase letter (e.g. 1.2E+2).                                                                                                                                                                                                                                                                           |
| `f`       | The argument is treated as a float and presented as a floating-point number (locale aware).                                                                                                                                                                                                                                               |
| `F`       | The argument is treated as a float and presented as a floating-point number (non-locale aware).                                                                                                                                                                                                                                           |
| `g`       | General format.<br><br>Let P equal the precision if nonzero, 6 if the precision is omitted, or 1 if the precision is zero. Then, if a conversion with style E would have an exponent of X:<br><br>If P > X ≥ −4, the conversion is with style f and precision P − (X + 1). Otherwise, the conversion is with style e and precision P − 1. |
| `G`       | Like the `g` specifier but uses `E` and `f`.                                                                                                                                                                                                                                                                                              |
| `h`       | Like the `g` specifier but uses `F`. Available as of PHP 8.0.0.                                                                                                                                                                                                                                                                           |
| `H`       | Like the `g` specifier but uses `E` and `F`. Available as of PHP 8.0.0.                                                                                                                                                                                                                                                                   |
| `o`       | The argument is treated as an integer and presented as an octal number.                                                                                                                                                                                                                                                                   |
| `s`       | The argument is treated and presented as a string.                                                                                                                                                                                                                                                                                        |
| `u`       | The argument is treated as an integer and presented as an unsigned decimal number.                                                                                                                                                                                                                                                        |
| `x`       | The argument is treated as an integer and presented as a hexadecimal number (with lowercase letters).                                                                                                                                                                                                                                     |
| `X`       | The argument is treated as an integer and presented as a hexadecimal number (with uppercase letters).                                                                                                                                                                                                                                     |

**Warning**

The `c` type specifier ignores padding and width.

**Warning**

Attempting to use a combination of the string and width specifiers with character sets that require more than one byte per character may result in unexpected results.

Variables will be co-erced to a suitable type for the specifier:

**Type Handling**

| Type                                                              | Specifiers                             |
| ----------------------------------------------------------------- | -------------------------------------- |
| [string](https://www.php.net/manual/en/language.types.string.php) | `s`                                    |
| [int](https://www.php.net/manual/en/language.types.integer.php)   | `d`, `u`, `c`, `o`, `x`, `X`, `b`      |
| [float](https://www.php.net/manual/en/language.types.float.php)   | `e`, `E`, `f`, `F`, `g`, `G`, `h`, `H` |

### Format Template

```php
%[parameter][flags][width][.precision][length]type
```

#### Where:

- parameter: Position of argument (e.g., `1$`)
- flags: `-`, `+`, space, `0`, `#`, `'`
- width: Minimum number of characters to output
- precision: Maximum number of characters or decimal places
- length: Size of argument (e.g., `h`, `l`, `L`)
- type: The placeholder type from above list

## Examples:

```php
// String examples
$str = "Hello";
echo "Basic string: %s\n", $str);                    // Output: Basic string: Hello
echo sprintf("Padded string: %10s\n", $str);         // Output: Padded string:      Hello
echo sprintf("Left-aligned: %-10s\n", $str);         // Output: Left-aligned: Hello
echo sprintf("Truncated: %.3s\n", $str);             // Output: Truncated: Hel

// Integer examples
$num = 42;
echo sprintf("Basic integer: %d\n", $num);           // Output: Basic integer: 42
echo sprintf("Padded integer: %05d\n", $num);        // Output: Padded integer: 00042
echo sprintf("With sign: %+d\n", $num);              // Output: With sign: +42
echo sprintf("Space for sign: % d\n", $num);         // Output: Space for sign:  42

// Float examples
$float = 3.14159;
echo sprintf("Basic float: %f\n", $float);           // Output: Basic float: 3.141590
echo sprintf("Limited decimals: %.2f\n", $float);    // Output: Limited decimals: 3.14
echo sprintf("Padded float: %08.2f\n", $float);      // Output: Padded float: 00003.14
echo sprintf("With sign: %+.2f\n", $float);          // Output: With sign: +3.14

// Scientific notation
$large = 1234.56789;
echo sprintf("Lowercase scientific: %e\n", $large);   // Output: Lowercase scientific: 1.234568e+3
echo sprintf("Uppercase scientific: %E\n", $large);   // Output: Uppercase scientific: 1.234568E+3
echo sprintf("Limited decimals: %.2e\n", $large);    // Output: Limited decimals: 1.23e+3

// Automatic format (%g/%G)
echo sprintf("Auto format small: %g\n", 0.00001);    // Output: Auto format small: 1e-5
echo sprintf("Auto format large: %g\n", 1234);       // Output: Auto format large: 1234

// Octal and Hexadecimal
$num = 255;
echo sprintf("Octal: %o\n", $num);                   // Output: Octal: 377
echo sprintf("Hex lowercase: %x\n", $num);           // Output: Hex lowercase: ff
echo sprintf("Hex uppercase: %X\n", $num);           // Output: Hex uppercase: FF
echo sprintf("Hex with prefix: %#x\n", $num);        // Output: Hex with prefix: 0xff

// Character
$char = 65;  // ASCII for 'A'
echo sprintf("Character: %c\n", $char);              // Output: Character: A
echo sprintf("Padded character: %3c\n", $char);      // Output: Padded character:   A

// Percent sign
echo sprintf("Show percent: %%\n");                  // Output: Show percent: %

// Multiple arguments
echo sprintf("Multiple: %d %s %.2f\n", 42, "test", 3.14); // Output: Multiple: 42 test 3.14

// Position specifiers
echo sprintf("Reordered: %2$s %1$d %3$.2f\n", 42, "test", 3.14); // Output: Reordered: test 42 3.14

// Width from argument
echo sprintf("Variable width: %*s\n", 10, "Hello");  // Output: Variable width:      Hello

// Precision from argument
echo sprintf("Variable precision: %.*f\n", 2, 3.14159);  // Output: Variable precision: 3.14

// Grouping with thousands separator
$big = 1234567;
echo sprintf("Grouped number: %'d\n", $big);        // Output: Grouped number: 1,234,567

// Custom padding
echo sprintf("Custom padding: %'_10s\n", "Hi");     // Output: Custom padding: ________Hi

// Combining multiple options
echo sprintf("Combined: %+08.2f\n", 3.14);          // Output: Combined: +0003.14

// Using %n (stores count of characters written so far)
$count = 0;
sprintf("Count chars%n\n", $count);
echo sprintf("Characters written: %d\n", $count);    // Output: Characters written: 11

// Demonstrate precision differences
// For integers (minimum digits)
echo sprintf("Integer precision: %.5d\n", 42);      // Output: Integer precision: 00042
// For strings (maximum length)
echo sprintf("String precision: %.5s\n", "Hello World"); // Output: String precision: Hello
// For floats (decimal places)
echo sprintf("Float precision: %.5f\n", 3.14);      // Output: Float precision: 3.14000
```

# sprintf() Placeholder Reference Guide

## Base Placeholders

### `%s` - String

###### - Options:

- Width (e.g., `%20s`)
- Left-justify with negative width (e.g., `%-20s`)
- Maximum string length with precision (e.g., `%.10s`)
- Padding with spaces (e.g., `%'_20s`)

### `%d` or `%i` - Integer

###### - Options:

- Width (e.g., `%5d`)
- Left-justify with negative width (e.g., `%-5d`)
- Zero-padding (e.g., `%05d`)
- Sign forced (e.g., `%+d`)
- Space reserved for sign (e.g., `% d`)
- Grouping separator (e.g., `%'d`)

### `%f` - Float/Double

###### - Options:

- Width (e.g., `%10f`)
- Left-justify with negative width (e.g., `%-10f`)
- Zero-padding (e.g., `%010f`)
- Precision after decimal (e.g., `%.2f`)
- Sign forced (e.g., `%+f`)
- Space reserved for sign (e.g., `% f`)
- Grouping separator (e.g., `%'f`)

### `%F` - Float/Double (uppercase)

- Same options as `%f` but uses uppercase E for scientific notation

### `%e` - Scientific notation (lowercase)

###### - Options:

- Width (e.g., `%10e`)
- Left-justify with negative width (e.g., `%-10e`)
- Zero-padding (e.g., `%010e`)
- Precision after decimal (e.g., `%.2e`)
- Sign forced (e.g., `%+e`)
- Space reserved for sign (e.g., `% e`)

### `%E` - Scientific notation (uppercase)

- Same options as `%e` but uses uppercase `E`

### `%g` - Shorter of `%e` or `%f`

###### - Options:

- Width (e.g., `%10g`)
- Left-justify with negative width (e.g., `%-10g`)
- Zero-padding (e.g., `%010g`)
- Precision (e.g., `%.2g`)
- Sign forced (e.g., `%+g`)
- Space reserved for sign (e.g., `% g`)

### `%G` - Shorter of `%E` or `%F`

- Same options as `%g` but uses uppercase `E`

### `%o` - Octal

###### - Options:

- Width (e.g., `%5o`)
- Left-justify with negative width (e.g., `%-5o`)
- Zero-padding (e.g., `%05o`)
- Alternative form with leading zero (e.g., `%#o`)

### %x - Hexadecimal (lowercase)

###### - Options:

- Width (e.g., `%5x`)
- Left-justify with negative width (e.g., `%-5x`)
- Zero-padding (e.g., `%05x`)
- Alternative form with 0x prefix (e.g., `%#x`)

### `%X` - Hexadecimal (uppercase)

- Same options as %x but uses uppercase letters

### `%c `- Single character

###### - Options:

- Width (e.g., `%5c`)
- Left-justify with negative width (e.g., `%-5c`)

### `%%` - Literal percent sign

- No options available

### `%n` - Nothing printed

- Stores the number of characters written so far into a variable
- No formatting options available

## Special Options Available for All Numeric Types (`%d`, `%i`, `%f`, `%F`, `%e`, `%E`, `%g`, `%G`, `%o`, `%x`, `%X`)

##### 1. Width specification

- Fixed width: `%5d`
- Variable width from argument: `%*d`

##### 2. Precision specification

- Fixed precision: `%.2f`
- Variable precision from argument: `%.*f`

##### 3. Argument order control

- Positional parameters: `%1$d`
- Reuse parameters: `%1$d %1$d`

##### 4. Sign options

- Force sign: `%+d`
- Space for sign: `% d`

##### 5. Alignment options

- Left justify: `%-5d`
- Right justify: `%5d`

##### 6. Padding options

- Zero padding: `%05d`
- Custom padding: `%'_5d`

## Unique Features/Limitations

###### 1. String placeholder (`%s`):

- Only accepts precision to limit string length
- Cannot use sign options
- Cannot use zero padding

###### 2. Character placeholder (`%c`):

- Cannot use precision
- Cannot use sign options
- Cannot use zero padding
- Cannot use grouping

###### 3. Integer types (`%d`, `%i`, `%o`, `%x`, `%X`):

- Precision means minimum number of digits
- Precision will override zero padding

###### 4. Floating point types (`%f`, `%F`, `%e`, `%E`, `%g`, `%G`):

- Precision means decimal places
- Default precision is 6 if not specified

###### 5. Literal percent (`%%`):

- Cannot use any formatting options
- Must be used to print a literal % character

###### 6. `%n` type:

- Unique in that it doesn't print anything
- Used to store the number of characters output so far
- Cannot use any formatting options
