---
created: 2024-10-28T17:36:58-04:00
modified: 2024-10-28T19:43:14-04:00
tags:
  - validation
  - form-validate
  - database
  - rules
  - laravel
  - codeigniter4
  - parser
  - string-parser
  - validation-parser
---

## USER **php filled array of validation requirements**

Has any repo used a php filled array of validation requirements for form submission and or for database checks prior to inserting dependent on the columns in the database and or the fields in the form being submitted? If so, what do the unique array values look like, and what repos have tried doing this?

## ASSISTANT

Yes, PHP applications often use arrays to define validation rules for form submissions and database checks. This pattern is common in frameworks like **Laravel** or **Symfony**, but can also be found in custom PHP code. These arrays define the validation rules dependent on the form fields or the database columns.

A common example is using an associative array where the key represents the form field (or database column), and the value specifies the validation rules. Each validation rule can be a string, an array, or a callable function.

### Example of a validation array:

```php
$validation_rules = [
    'username' => ['required', 'min:5', 'max:20', 'unique:users,username'],
    'email'    => ['required', 'email', 'unique:users,email'],
    'password' => ['required', 'min:8', 'confirmed'],
    'age'      => ['required', 'integer', 'min:18'],
];
```

#### Explanation:

- **username**: Must be provided (`required`), have a minimum length of 5 characters, a maximum of 20, and must be unique in the `users` table under the `username` column.
- **email**: Must be provided, formatted as a valid email, and be unique in the `users` table under the `email` column.
- **password**: Required, with a minimum length of 8 characters and confirmed by matching another field (usually a `password_confirmation`).
- **age**: Must be an integer and at least 18.

### Example Repositories and Frameworks:

1. **Laravel** – Laravel's [validation system](https://laravel.com/docs/10.x/validation) makes heavy use of such arrays. You can find this in any Laravel project, usually inside `FormRequest` classes or in controllers.
2. **Symfony** – Symfony also uses a similar concept, though often more declarative using annotations or YAML, but arrays can also be used.
3. **CakePHP** – Uses a similar structure for validation in model entities. You can see examples in their [ORM validation](https://book.cakephp.org/4/en/orm/validation.html).
4. **CodeIgniter** – Uses associative arrays for validation, check their [form validation documentation](https://codeigniter.com/user_guide/libraries/form_validation.html).

These arrays make it easy to extend validation rules by adding custom ones, and many frameworks even support conditional validation based on other fields.

## USER **Laravels Validation Options**

For laravel validation, what are all the options we can put in that line ‘required|unique:posts|max:255’ what are all the options we put in there to validate for?

## ASSISTANT

Laravel provides a rich set of validation rules that you can use in your validation arrays. Below is a comprehensive list of commonly used rules that can be applied in a validation string like `'required|unique:posts|max:255'`.

### Common Laravel Validation Rules:

#### **Basic Rules:**

| rule            | desc                                                                                  |
| --------------- | ------------------------------------------------------------------------------------- |
| **`required`**: | Field must be present and not empty.                                                  |
| **`nullable`**: | Field is allowed to be null.                                                          |
| **`filled`**:   | Field must be present, but can be empty (useful when combined with other conditions). |
| **`present`**:  | Field must be present, even if it’s empty.                                            |

#### **String/Size Rules:**

| rule                   | desc                                                                                                                    |
| ---------------------- | ----------------------------------------------------------------------------------------------------------------------- |
| **`min:value`**:       | The field's value must have a minimum length, or be greater than or equal to a given numeric value (depending on type). |
| **`max:value`**:       | Field's value must not exceed a maximum length or value.                                                                |
| **`size:value`**:      | The field must be exactly the given size (applies to string length, array count, or file size).                         |
| **`between:min,max`**: | Value must be within a specified range of min and max.                                                                  |

#### **String Rules:**

| rule                   | desc                                                         |
| ---------------------- | ------------------------------------------------------------ |
| **`string`**:          | Field must be a string.                                      |
| **`alpha`**:           | Field must contain only alphabetic characters.               |
| **`alpha_num`**:       | Field must contain only alphabetic and numeric characters.   |
| **`alpha_dash`**:      | Field may contain letters, numbers, dashes, and underscores. |
| **`regex:/pattern/`**: | Field must match a regular expression pattern.               |

#### **Numeric Rules:**

| rule                          | desc                                            |
| ----------------------------- | ----------------------------------------------- |
| **`numeric`**:                | Field must be a number.                         |
| **`integer`**:                | Field must be an integer.                       |
| **`digits:value`**:           | Must be exactly `value` digits long.            |
| **`digits_between:min,max`**: | Must be between `min` and `max` digits.         |
| **`gt:field`**:               | Must be greater than another field or value.    |
| **`lt:field`**:               | Must be less than another field or value.       |
| **`gte:field`**:              | Must be greater than or equal to another field. |
| **`lte:field`**:              | Must be less than or equal to another field.    |

#### **Date and Time Rules:**

| rule                        | desc                                             |
| --------------------------- | ------------------------------------------------ |
| **`date`**:                 | Field must be a valid date.                      |
| **`date_format:format`**:   | Must match a specified date format.              |
| **`before:date`**:          | Date must be before a given date.                |
| **`after:date`**:           | Date must be after a given date.                 |
| **`before_or_equal:date`**: | Must be a date before or equal to the given one. |
| **`after_or_equal:date`**:  | Must be a date after or equal to the given one.  |

#### **File Rules:**

| rule                   | desc                                                                                  |
| ---------------------- | ------------------------------------------------------------------------------------- |
| **`file`**:            | Field must be an uploaded file.                                                       |
| **`image`**:           | File must be an image (jpeg, png, bmp, gif, svg, webp).                               |
| **`mimes:types`**:     | File must be of one of the specified MIME types, e.g., `mimes:jpg,bmp,png`.           |
| **`mimetypes:types`**: | File must match a specific set of MIME types.                                         |
| **`max:value`**:       | File must not be larger than the specified number of kilobytes.                       |
| **`dimensions`**:      | Used for image dimension constraints, like `dimensions:min_width=100,min_height=200`. |

#### **Email, URL, and IP Rules:**

| rule               | desc                                   |
| ------------------ | -------------------------------------- |
| **`email`**:       | Field must be a valid email address.   |
| **`url`**:         | Field must be a valid URL.             |
| **`active_url`**:  | Field must be a valid, accessible URL. |
| **`ip`**:          | Must be a valid IP address.            |
| **`ipv4`**:        | Must be a valid IPv4 address.          |
| **`ipv6`**:        | Must be a valid IPv6 address.          |
| **`mac_address`**: | Must be a valid MAC address.           |

#### **Array Rules:**

| rule                 | desc                                                          |
| -------------------- | ------------------------------------------------------------- |
| **`array`**:         | Field must be an array.                                       |
| **`in:values`**:     | The field's value must be one of the provided list of values. |
| **`not_in:values`**: | The field's value must _not_ be in the provided list.         |
| **`distinct`**:      | Ensures no duplicate values in an array.                      |

#### **Boolean Rules:**

| rule           | desc                                                                       |
| -------------- | -------------------------------------------------------------------------- |
| **`boolean`**: | The field must be `true` or `false` (or equivalents like `1/0`, `on/off`). |

#### **Database Rules:**

| rule                       | desc                                                                                            |
| -------------------------- | ----------------------------------------------------------------------------------------------- |
| **`unique:table,column`**: | Field must be unique in a specific database table. Optionally: `unique:table,column,ignore_id`. |
| **`exists:table,column`**: | The field must exist in a specific column in the database.                                      |

#### **Custom Validation Rules:**

| rule                   | desc                                                                                   |
| ---------------------- | -------------------------------------------------------------------------------------- |
| **`confirmed`**:       | Requires confirmation by checking another field (`password_confirmation` for example). |
| **`same:field`**:      | The value must match the value of another specified field.                             |
| **`different:field`**: | The value must be different from another specified field.                              |
| **`accepted`**:        | Must be `yes`, `on`, `1`, or `true` (typically used for agreeing to terms).            |
| **`nullable`**:        | Field can be null.                                                                     |
| **`sometimes`**:       | Only apply the validation if the field is present.                                     |

#### **Other Rules:**

| rule                        | desc                                                              |
| --------------------------- | ----------------------------------------------------------------- |
| **`uuid`**:                 | Field must be a valid UUID.                                       |
| **`json`**:                 | Field must be a valid JSON string.                                |
| **`ends_with:value`**:      | Field must end with one of the given values.                      |
| **`starts_with:value`**:    | Field must start with one of the given values.                    |
| **`prohibited`**:           | The field must not be present.                                    |
| **`prohibits:otherfield`**: | Prohibits the presence of another field if this field is present. |

### Example:

Here’s an example of applying various validation rules:

```php
$request->validate([
    'name'      => 'required|string|max:255',
    'email'     => 'required|email|unique:users,email',
    'age'       => 'required|integer|min:18',
    'website'   => 'nullable|url',
    'password'  => 'required|string|min:8|confirmed',
    'bio'       => 'nullable|string|max:500',
    'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
]);
```

### Custom Validation Rules

You can also define custom validation rules using closures, or by creating custom rule objects using Laravel’s `make:rule` Artisan command.

For full details, you can refer to Laravel's official [validation documentation](https://laravel.com/docs/10.x/validation).

## USER **Codeigniter4 Validation Options**

For codeigniter4 validation, what are all the options we can put in that line ‘required|max_length[255]|min_length[10]’ what are all the options we put in there to validate for?

## ASSISTANT

In CodeIgniter 4, validation rules can be applied in a similar way using a pipe (`|`) to separate multiple rules. Below is a comprehensive list of all the validation rules you can use in CodeIgniter 4, with examples:

### Common CodeIgniter 4 Validation Rules:

#### **Basic Rules:**

| rule                 | desc                                                                                              |
| -------------------- | ------------------------------------------------------------------------------------------------- |
| **`required`**:      | The field must not be empty.                                                                      |
| **`permit_empty`**:  | The field is allowed to be empty (used alongside other rules like `valid_email`).                 |
| **`in_list[list]`**: | The field value must be one of the values in the provided list (e.g., `in_list[red,blue,green]`). |

#### **String Rules:**

| rule                        | desc                                                                                          |
| --------------------------- | --------------------------------------------------------------------------------------------- | -------- |
| **`min_length[value]`**:    | The string must have at least `value` characters (e.g., `min_length[10]`).                    |
| **`max_length[value]`**:    | The string must not exceed `value` characters (e.g., `max_length[255]`).                      |
| **`exact_length[value]`**:  | The string must be exactly `value` characters long.                                           |
| **`alpha`**:                | The field may only contain alphabetical characters (A-Z, a-z).                                |
| **`alpha_numeric`**:        | The field may only contain alphanumeric characters.                                           |
| **`alpha_numeric_space`**:  | The field may contain alphanumeric characters and spaces.                                     |
| **`alpha_dash`**:           | The field may contain alphanumeric characters, dashes, underscores.                           |
| **`alpha_numeric_punct`**:  | Allows alphanumeric characters, spaces, and the following punctuation: `~!#@$%^&\*()\_-+=     | :;,.<>?` |
| **`regex_match[pattern]`**: | The field value must match the regular expression provided (e.g., `regex_match[/^[a-z]+$/]`). |

#### **Numeric Rules:**

| rule                                | desc                                                                            |
| ----------------------------------- | ------------------------------------------------------------------------------- |
| **`numeric`**:                      | The field must contain only numeric values.                                     |
| **`integer`**:                      | The field must contain an integer.                                              |
| **`decimal`**:                      | The field must contain a decimal number.                                        |
| **`greater_than[value]`**:          | The field must contain a number greater than `value` (e.g., `greater_than[5]`). |
| **`greater_than_equal_to[value]`**: | The field must contain a number greater than or equal to `value`.               |
| **`less_than[value]`**:             | The field must contain a number less than `value`.                              |
| **`less_than_equal_to[value]`**:    | The field must contain a number less than or equal to `value`.                  |

#### **Date Rules:**

| rule                            | desc                                                                              |
| ------------------------------- | --------------------------------------------------------------------------------- |
| **`valid_date`**:               | Ensures that the field contains a valid date format.                              |
| **`valid_date[format]`**:       | Checks that the field matches a specific date format (e.g., `valid_date[Y-m-d]`). |
| **`greater_than_date[field]`**: | Ensures that the field date is greater than another field's value.                |
| **`less_than_date[field]`**:    | Ensures that the field date is less than another field's value.                   |

#### **File Rules:**

| rule                              | desc                                                                                                                    |
| --------------------------------- | ----------------------------------------------------------------------------------------------------------------------- |
| **`uploaded[field]`**:            | Ensures a file was uploaded.                                                                                            |
| **`max_size[field,value]`**:      | Ensures the uploaded file is not larger than the specified size (in kilobytes).                                         |
| **`is_image[field]`**:            | Ensures the uploaded file is a valid image.                                                                             |
| **`mime_in[field, mime_types]`**: | Ensures the uploaded file matches one of the allowed MIME types (e.g., `mime_in[file,image/jpg,image/jpeg,image/gif]`). |
| **`ext_in[field, extensions]`**:  | Ensures the file has one of the allowed extensions (e.g., `ext_in[file,jpg,jpeg,png,gif]`).                             |

#### **Email and URL Rules:**

| rule                | desc                                                            |
| ------------------- | --------------------------------------------------------------- |
| **`valid_email`**:  | Ensures that the field contains a valid email address.          |
| **`valid_emails`**: | Ensures that the field contains multiple valid email addresses. |
| **`valid_url`**:    | Ensures that the field contains a valid URL.                    |

#### **Array and List Rules:**

| rule                          | desc                                                                                                    |
| ----------------------------- | ------------------------------------------------------------------------------------------------------- |
| **`is_unique[table.field]`**: | Ensures the field value is unique in the specified table and column (e.g., `is_unique[users.email]`).   |
| **`differs[field]`**:         | Ensures the field is different from another specified field.                                            |
| **`matches[field]`**:         | Ensures the field matches the value of another specified field (often used with password confirmation). |

#### **Boolean Rules:**

| rule                      | desc                                                                                      |
| ------------------------- | ----------------------------------------------------------------------------------------- |
| **`boolean`**:            | Ensures that the field contains a boolean value (`true`/`false`, `1`/`0`, or `yes`/`no`). |
| **`is_natural`**:         | Ensures the field contains only natural numbers (0 and positive integers).                |
| **`is_natural_no_zero`**: | Ensures the field contains only natural numbers greater than 0.                           |

#### **Custom Validation Rules:**

| rule                       | desc                                                                                                    |
| -------------------------- | ------------------------------------------------------------------------------------------------------- |
| **`callback_methodName`**: | Allows you to call a custom validation method in the controller or model (e.g., `callback_check_date`). |

### Example:

Here’s an example applying various validation rules to form fields:

```php
$validation_rules = [
    'username'    => 'required|alpha_numeric|min_length[5]|max_length[20]',
    'email'       => 'required|valid_email|is_unique[users.email]',
    'password'    => 'required|min_length[8]',
    'age'         => 'required|integer|greater_than[17]',
    'profile_pic' => 'uploaded[profile_pic]|is_image[profile_pic]|max_size[profile_pic,2048]|mime_in[profile_pic,image/jpg,image/jpeg,image/png]',
    'bio'         => 'permit_empty|max_length[500]',
];
```

### Validation Errors

When the validation fails, you can retrieve validation errors with:

```php
$validation = \Config\Services::validation();
if (! $validation->run($data, $validation_rules)) {
    $errors = $validation->getErrors(); // Array of errors
}
```

For full details on CodeIgniter 4 validation, you can check their official [validation documentation](https://codeigniter.com/user_guide/libraries/validation.html).

## USER **Parser to render validations**

I’d like to see what a parser looks like to be able to explode each of those values and from laravel and codeigniter4 validation techniques and ensure it validates all the options available

## ASSISTANT

To build a parser that can handle validation rules from both **Laravel** and **CodeIgniter 4**, you need a method that can break down (explode) the validation strings into individual rules and ensure each rule is valid according to the specific framework's validation options.

### Steps to Build a Validation Rule Parser:

1. **Explode the rule string**: Break down the validation string by the pipe `|` character, which separates the rules.
2. **Handle parameters**: Some rules have additional parameters (like `min_length[10]` or `max:255`), so you'll need to extract those values.
3. **Check if the rule is valid**: You'll need to have a list of valid rules for both Laravel and CodeIgniter to compare against.
4. **Return a validation response**: Either confirm the rule is valid or return an error message for invalid rules.

Here's a simplified PHP example of how you can parse validation strings and ensure that they are valid for both Laravel and CodeIgniter 4.

### PHP Parser Example:

```php
<?php

class ValidationRuleParser
{
    // Define Laravel and CodeIgniter valid rules
    private $laravelRules = [
        'required', 'nullable', 'min', 'max', 'email', 'unique', 'confirmed', 'regex', 'size', 'in', 'not_in',
        'integer', 'string', 'boolean', 'date', 'image', 'file', 'mimes', 'digits', 'active_url', 'exists', 'gt', 'lt'
        // Add more rules as needed
    ];

    private $codeigniterRules = [
        'required', 'permit_empty', 'min_length', 'max_length', 'integer', 'numeric', 'valid_email', 'is_unique',
        'uploaded', 'is_image', 'greater_than', 'less_than', 'exact_length', 'valid_url', 'matches', 'in_list',
        'regex_match', 'alpha', 'alpha_numeric'
        // Add more rules as needed
    ];

    // Parser function
    public function parse($ruleString, $framework)
    {
        $rules = explode('|', $ruleString); // Split the rule string by '|'
        $validRules = $framework === 'laravel' ? $this->laravelRules : $this->codeigniterRules;

        $parsedRules = [];
        $errors = [];

        foreach ($rules as $rule) {
            // Handle rules with parameters, e.g., min:10 or max_length[255]
            if (strpos($rule, ':') !== false || strpos($rule, '[') !== false) {
                [$ruleName, $params] = $this->extractRuleAndParams($rule);
            } else {
                $ruleName = $rule;
                $params = null;
            }

            // Validate if the rule is available in the respective framework
            if (in_array($ruleName, $validRules)) {
                $parsedRules[] = ['rule' => $ruleName, 'params' => $params];
            } else {
                $errors[] = "Invalid rule: $ruleName for $framework";
            }
        }

        return [
            'parsed' => $parsedRules,
            'errors' => $errors
        ];
    }

    // Extract rule and parameters (for both Laravel and CodeIgniter style)
    private function extractRuleAndParams($rule)
    {
        // Handle Laravel's rule format (min:10) and CodeIgniter's rule format (min_length[10])
        if (strpos($rule, ':') !== false) {
            // Laravel format: rule:parameter
            [$ruleName, $params] = explode(':', $rule);
        } elseif (strpos($rule, '[') !== false) {
            // CodeIgniter format: rule[parameter]
            preg_match('/(.+)\[(.+)\]/', $rule, $matches);
            $ruleName = $matches[1] ?? $rule;
            $params = $matches[2] ?? null;
        } else {
            $ruleName = $rule;
            $params = null;
        }

        return [$ruleName, $params];
    }
}

// Example usage:

$parser = new ValidationRuleParser();

// Laravel example
$laravelValidation = 'required|max:255|min:10|email|unique:users,email';
$laravelResult = $parser->parse($laravelValidation, 'laravel');

echo "Laravel Parsing Result:\n";
print_r($laravelResult);

// CodeIgniter example
$codeigniterValidation = 'required|max_length[255]|min_length[10]|valid_email|is_unique[users.email]';
$codeigniterResult = $parser->parse($codeigniterValidation, 'codeigniter');

echo "\nCodeIgniter Parsing Result:\n";
print_r($codeigniterResult);
```

### How the Parser Works:

1. **Laravel Validation Rules**:

   - The parser splits the validation string (`required|max:255|min:10|email|unique:users,email`) by `|` to get each rule.
   - It checks for parameters (rules like `min:10`), splits by `:`, and validates against the predefined list of Laravel rules.
   - If the rule is valid, it's added to the parsed result. If it's not found in the list of valid rules, an error is generated.

2. **CodeIgniter Validation Rules**:
   - The same logic applies, but CodeIgniter’s parameters are enclosed in square brackets (`[]`), so the parser handles rules like `max_length[255]`.
   - The function `extractRuleAndParams` detects both Laravel-style (`rule:param`) and CodeIgniter-style (`rule[param]`) rules.
3. **Validation**:
   - The parser checks if the extracted rule name exists in the valid rules array for the selected framework (Laravel or CodeIgniter).
   - It returns an array of parsed rules along with any validation errors.

### Example Output:

#### Laravel Parsing Result:

```php
Laravel Parsing Result:
Array
(
    [parsed] => Array
        (
            [0] => Array
                (
                    [rule] => required
                    [params] =>
                )
            [1] => Array
                (
                    [rule] => max
                    [params] => 255
                )
            [2] => Array
                (
                    [rule] => min
                    [params] => 10
                )
            [3] => Array
                (
                    [rule] => email
                    [params] =>
                )
            [4] => Array
                (
                    [rule] => unique
                    [params] => users,email
                )
        )
    [errors] => Array
        (
        )
)
```

#### CodeIgniter Parsing Result:

```php
CodeIgniter Parsing Result:
Array
(
    [parsed] => Array
        (
            [0] => Array
                (
                    [rule] => required
                    [params] =>
                )
            [1] => Array
                (
                    [rule] => max_length
                    [params] => 255
                )
            [2] => Array
                (
                    [rule] => min_length
                    [params] => 10
                )
            [3] => Array
                (
                    [rule] => valid_email
                    [params] =>
                )
            [4] => Array
                (
                    [rule] => is_unique
                    [params] => users.email
                )
        )
    [errors] => Array
        (
        )
)
```

### Notes:

- This parser provides a basic structure. You could expand it by adding more validation rules or custom validation logic.
- In real-world scenarios, you would likely have dynamic rules (e.g., pulled from a configuration file or user input), so the parser could handle more flexible inputs.

## USER **Real World Examples**

Can you should me the real world example with expanding the validation rules to allow for more rules in a real world social networking website?

## ASSISTANT

Certainly! Below is a real-world example of a validation parser that could be used in a **social networking website**. This example covers common validation rules for user profile creation and updating actions, such as validating usernames, email addresses, passwords, profile pictures, and user biographies. We'll expand the parser to handle additional validation rules that are relevant to such a use case.

### Real-World Example: User Registration and Profile Update Validation Parser

Let's assume the following validation rules:

- **Username**: Must be alphanumeric, at least 5 characters long, and unique in the database.
- **Email**: Must be a valid email address and unique.
- **Password**: Must be at least 8 characters long, confirmed with a second password field.
- **Profile Picture**: Must be an uploaded file, an image with a valid MIME type, and a maximum size of 2MB.
- **Biography**: Optional, but if provided, should not exceed 500 characters.
- **Age**: Must be a number and at least 18 years old.

### Expanded Validation Rule Parser:

Here’s an updated version of the parser that handles more rules and provides validation for a **social networking website**.

```php
<?php

class SocialNetworkValidationParser
{
    // Define Laravel and CodeIgniter valid rules
    private $laravelRules = [
        'required', 'nullable', 'min', 'max', 'email', 'unique', 'confirmed', 'regex', 'size', 'in', 'not_in',
        'integer', 'string', 'boolean', 'date', 'image', 'file', 'mimes', 'digits', 'active_url', 'exists', 'gt', 'lt',
        'starts_with', 'ends_with', 'uuid', 'alpha', 'alpha_dash', 'alpha_num', 'accepted', 'confirmed'
    ];

    private $codeigniterRules = [
        'required', 'permit_empty', 'min_length', 'max_length', 'integer', 'numeric', 'valid_email', 'is_unique',
        'uploaded', 'is_image', 'greater_than', 'less_than', 'exact_length', 'valid_url', 'matches', 'in_list',
        'regex_match', 'alpha', 'alpha_numeric', 'alpha_dash', 'greater_than_equal_to', 'less_than_equal_to', 'valid_date'
    ];

    // Function to parse and validate rule strings
    public function parse($ruleString, $framework)
    {
        $rules = explode('|', $ruleString); // Split the rule string by '|'
        $validRules = $framework === 'laravel' ? $this->laravelRules : $this->codeigniterRules;

        $parsedRules = [];
        $errors = [];

        foreach ($rules as $rule) {
            // Handle rules with parameters, e.g., min:10 or max_length[255]
            if (strpos($rule, ':') !== false || strpos($rule, '[') !== false) {
                [$ruleName, $params] = $this->extractRuleAndParams($rule);
            } else {
                $ruleName = $rule;
                $params = null;
            }

            // Validate if the rule is available in the respective framework
            if (in_array($ruleName, $validRules)) {
                $parsedRules[] = ['rule' => $ruleName, 'params' => $params];
            } else {
                $errors[] = "Invalid rule: $ruleName for $framework";
            }
        }

        return [
            'parsed' => $parsedRules,
            'errors' => $errors
        ];
    }

    // Extract rule and parameters (for both Laravel and CodeIgniter style)
    private function extractRuleAndParams($rule)
    {
        // Handle Laravel's rule format (min:10) and CodeIgniter's rule format (min_length[10])
        if (strpos($rule, ':') !== false) {
            // Laravel format: rule:parameter
            [$ruleName, $params] = explode(':', $rule);
        } elseif (strpos($rule, '[') !== false) {
            // CodeIgniter format: rule[parameter]
            preg_match('/(.+)\[(.+)\]/', $rule, $matches);
            $ruleName = $matches[1] ?? $rule;
            $params = $matches[2] ?? null;
        } else {
            $ruleName = $rule;
            $params = null;
        }

        return [$ruleName, $params];
    }
}

// Example validation rules for a social networking website

$validationRules = [
    'username' => 'required|alpha_dash|min_length[5]|max_length[20]|is_unique[users.username]',
    'email' => 'required|valid_email|is_unique[users.email]',
    'password' => 'required|min_length[8]|matches[password_confirm]',
    'profile_pic' => 'permit_empty|uploaded[profile_pic]|is_image[profile_pic]|max_size[profile_pic,2048]|mime_in[profile_pic,image/jpg,image/jpeg,image/png]',
    'bio' => 'permit_empty|max_length[500]',
    'age' => 'required|integer|greater_than[17]'
];

// Instantiate the parser
$parser = new SocialNetworkValidationParser();

// Loop through validation rules and parse for CodeIgniter
foreach ($validationRules as $field => $ruleString) {
    $result = $parser->parse($ruleString, 'codeigniter');
    echo "\nField: $field\n";
    echo "Parsed Rules:\n";
    print_r($result['parsed']);
    if (!empty($result['errors'])) {
        echo "Errors:\n";
        print_r($result['errors']);
    }
}
```

### Real-World Example Breakdown:

1. **Username Validation**:

   - `required`: The username field is mandatory.
   - `alpha_dash`: Only alphanumeric characters, dashes, and underscores are allowed.
   - `min_length[5]`: The username must be at least 5 characters long.
   - `max_length[20]`: The username must not exceed 20 characters.
   - `is_unique[users.username]`: The username must be unique in the `users` table.

2. **Email Validation**:

   - `required`: The email field is mandatory.
   - `valid_email`: Must be a valid email address.
   - `is_unique[users.email]`: The email must be unique in the `users` table.

3. **Password Validation**:

   - `required`: The password field is mandatory.
   - `min_length[8]`: The password must be at least 8 characters long.
   - `matches[password_confirm]`: Ensures the password matches the confirmation field (`password_confirm`).

4. **Profile Picture Validation**:

   - `permit_empty`: The profile picture is optional.
   - `uploaded[profile_pic]`: Ensures the profile picture is uploaded if provided.
   - `is_image[profile_pic]`: The uploaded file must be an image.
   - `max_size[profile_pic,2048]`: The profile picture must not exceed 2MB.
   - `mime_in[profile_pic,image/jpg,image/jpeg,image/png]`: Restricts the profile picture to specific image formats (JPEG, PNG).

5. **Biography Validation**:

   - `permit_empty`: The biography is optional.
   - `max_length[500]`: The biography must not exceed 500 characters if provided.

6. **Age Validation**:
   - `required`: The age field is mandatory.
   - `integer`: Ensures the age is a number.
   - `greater_than[17]`: The age must be greater than 17 (i.e., the user must be at least 18 years old).

### Output Example:

When run, this code will parse the rules for each field and print the parsed rules or any validation errors.

```php
Field: username
Parsed Rules:
Array
(
    [0] => Array
        (
            [rule] => required
            [params] =>
        )
    [1] => Array
        (
            [rule] => alpha_dash
            [params] =>
        )
    [2] => Array
        (
            [rule] => min_length
            [params] => 5
        )
    [3] => Array
        (
            [rule] => max_length
            [params] => 20
        )
    [4] => Array
        (
            [rule] => is_unique
            [params] => users.username
        )
)
...
```

### Expansion Possibilities:

You can expand the validation rules as needed by adding more rules for different fields or types of validation specific to your application (e.g., phone numbers, social media links, etc.).

This example shows how a social networking website might use validation to ensure that user input is correct, secure, and conforms to business logic.

## USER **Using () to be different**

Ok, so laravel uses : and code igniter uses [], what’s a character we could use for validation that makes ours unique? While still keeping | to explode in the beginning. My goal would be to have something similar to both codeigniter and laravel but unique to me

## ASSISTANT

To create a unique validation syntax while maintaining the `|` separator used for rule separation (similar to both Laravel and CodeIgniter), you can choose a different symbol for parameterized rules.

### Proposal for a Unique Syntax:

You can use **parentheses `()`** for parameterized rules to distinguish your system from Laravel (`:`) and CodeIgniter (`[]`). This maintains the readability of the rules and keeps the parameter close to the rule name. For example:

**Example validation string**: `'required|max(255)|min(10)|alpha_dash|unique(users.username)'`

### Why parentheses `()`?

1. **Unique**: This differs from Laravel’s `:` and CodeIgniter’s `[]`, while still being intuitive.
2. **Readability**: Parentheses naturally convey the idea of passing arguments or parameters (as seen in function calls), making the validation logic more intuitive to read and implement.
3. **Easy Parsing**: It’s easy to parse because the parentheses can be easily identified and extracted in a similar way to how Laravel’s `:` and CodeIgniter’s `[]` are processed.

### Example:

Let's create an updated parser that uses parentheses `()` for parameters in your custom validation format.

### PHP Example: Custom Validation Parser

```php
<?php

class CustomValidationParser
{
    // Define a set of valid rules for the custom validation system
    private $customRules = [
        'required', 'nullable', 'min', 'max', 'email', 'unique', 'confirmed', 'regex', 'alpha_dash', 'integer', 'string',
        'boolean', 'date', 'image', 'file', 'mime', 'size', 'digits', 'active_url', 'exists', 'gt', 'lt', 'alpha',
        'alpha_num', 'starts_with', 'ends_with', 'uuid'
    ];

    // Function to parse and validate the custom validation string
    public function parse($ruleString)
    {
        $rules = explode('|', $ruleString); // Split the rule string by '|'
        $parsedRules = [];
        $errors = [];

        foreach ($rules as $rule) {
            // Handle rules with parameters, e.g., max(255) or unique(users.username)
            if (strpos($rule, '(') !== false) {
                [$ruleName, $params] = $this->extractRuleAndParams($rule);
            } else {
                $ruleName = $rule;
                $params = null;
            }

            // Validate if the rule is in the custom set of rules
            if (in_array($ruleName, $this->customRules)) {
                $parsedRules[] = ['rule' => $ruleName, 'params' => $params];
            } else {
                $errors[] = "Invalid rule: $ruleName";
            }
        }

        return [
            'parsed' => $parsedRules,
            'errors' => $errors
        ];
    }

    // Function to extract rule and its parameters using parentheses '()'
    private function extractRuleAndParams($rule)
    {
        // Extract rule name and parameter within parentheses, e.g., max(255)
        preg_match('/(.+)\((.+)\)/', $rule, $matches);
        $ruleName = $matches[1] ?? $rule;
        $params = $matches[2] ?? null;

        return [$ruleName, $params];
    }
}

// Example usage
$validationRules = [
    'username' => 'required|alpha_dash|min(5)|max(20)|unique(users.username)',
    'email'    => 'required|email|unique(users.email)',
    'password' => 'required|min(8)|confirmed',
    'profile_pic' => 'nullable|image|mime(image/jpg,image/jpeg,image/png)|max(2048)',
    'bio'      => 'nullable|max(500)',
    'age'      => 'required|integer|gt(17)'
];

$parser = new CustomValidationParser();

// Loop through validation rules and parse
foreach ($validationRules as $field => $ruleString) {
    $result = $parser->parse($ruleString);
    echo "\nField: $field\n";
    echo "Parsed Rules:\n";
    print_r($result['parsed']);
    if (!empty($result['errors'])) {
        echo "Errors:\n";
        print_r($result['errors']);
    }
}
```

### Output Example:

```php
Field: username
Parsed Rules:
Array
(
    [0] => Array
        (
            [rule] => required
            [params] =>
        )
    [1] => Array
        (
            [rule] => alpha_dash
            [params] =>
        )
    [2] => Array
        (
            [rule] => min
            [params] => 5
        )
    [3] => Array
        (
            [rule] => max
            [params] => 20
        )
    [4] => Array
        (
            [rule] => unique
            [params] => users.username
        )
)
...
```

### Explanation:

1. **Unique Syntax**:
   - In your custom validation syntax, you use parentheses `()` for parameters, which makes it distinct from Laravel (`:`) and CodeIgniter (`[]`).
2. **Rule Parsing**:
   - The parser splits the validation rules using the pipe (`|`).
   - It then checks if the rule contains parentheses. If so, it extracts the rule name and parameters, otherwise, it treats it as a rule without parameters.
3. **Custom Validation Example**:
   - **`username`**: The username must be `required`, follow the `alpha_dash` format, have a `min` length of 5, a `max` length of 20, and be `unique` in the `users.username` column.
   - **`email`**: The email must be required, valid, and unique.
   - **`password`**: The password must be required, have a minimum length of 8 characters, and be confirmed (match a confirmation field).
   - **`profile_pic`**: This is optional (`nullable`), but if provided, must be an `image` of specific MIME types (`jpg`, `jpeg`, `png`) and cannot exceed 2MB in size.
   - **`bio`**: The biography is optional (`nullable`) but cannot exceed 500 characters.
   - **`age`**: The age must be required, an integer, and greater than 17.

### Advantages:

- **Readable**: The parentheses format makes it easier for developers to understand what parameters are being passed.
- **Distinct**: Using parentheses sets your system apart from Laravel and CodeIgniter, while still adhering to a clear and logical structure.
- **Easy to Extend**: You can easily expand the list of rules or modify the parser to accommodate more complex logic.

### Further Enhancements:

- **Custom Error Messages**: You can extend the parser to include custom error messages for specific rules.
- **Complex Rules**: Expand the rule set to handle nested rules, conditional validation, or multi-field validation.
- **Custom Validation Methods**: You can add support for custom validation methods defined by the user. For example, if the user wants to add a rule like `strong_password()` to enforce specific password policies, you can allow that by registering custom rules.

By adopting this custom format, you're creating a unique validation approach while keeping the advantages of both Laravel and CodeIgniter-style validation techniques.
