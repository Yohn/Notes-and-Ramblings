---
created: 2024-10-28T18:21:36-04:00
modified: 2024-10-28T20:41:32-04:00
---

|           Description           |           Laravel            |          CodeIgniter           | Yohns  |
| :-----------------------------: | :--------------------------: | :----------------------------: | :----: |
|     Required field presence     |        **`required`**        |         **`required`**         |   ✔️   |
|      Can be null or empty       |        **`nullable`**        |       **`permit_empty`**       |   ✔️   |
|    Must have non-null value     |         **`filled`**         |                                |        |
|       Must be present key       |        **`present`**         |                                |        |
|    Boolean value validation     |        **`boolean`**         |         **`boolean`**          |        |
|     Minimum length or value     |       **`min:value`**        |    **`min_length[value]`**     |   ✔️   |
|     Maximum length or value     |       **`max:value`**        |    **`max_length[value]`**     |   ✔️   |
|                                 |                              |   **`exact_length[value]`**    |        |
|    Specific size constraint     |       **`size:value`**       |                                |   ✔️   |
|   Value must be within range    |    **`between:min,max`**     |                                |        |
|      Value must be string       |         **`string`**         |                                |        |
|   Alphabetic characters only    |         **`alpha`**          |                                |        |
|     Alphanumeric characters     |       **`alpha_num`**        |                                |        |
| Alphabetic, dashes, underscores |       **`alpha_dash`**       |                                |        |
|       Regex pattern match       |    **`regex:/pattern/`**     |   **`regex_match[pattern]`**   |        |
|          Numeric value          |        **`numeric`**         |         **`numeric`**          |        |
|      Integer numeric value      |        **`integer`**         |         **`integer`**          |        |
|                                 |                              |         **`decimal`**          |        |
|   Digits with specific value    |      **`digits:value`**      |                                |        |
|     Digits between min/max      | **`digits_between:min,max`** |                                |        |
|    Greater than field value     |        **`gt:field`**        |   **`greater_than[value]`**    |        |
|      Less than field value      |        **`lt:field`**        |     **`less_than[value]`**     |        |
|    Greater than or equal to     |       **`gte:field`**        |                                |        |
|      Less than or equal to      |       **`lte:field`**        |                                |        |
|         Date validation         |          **`date`**          |        **`valid_date`**        |        |
|     Date format validation      |   **`date_format:format`**   |    **`valid_date[format]`**    |        |
|    Date before specific date    |      **`before:date`**       | **`greater_than_date[field]`** |        |
|    Date after specific date     |       **`after:date`**       |  **`less_than_date[field]`**   |        |
|     Date before or equal to     |  **`before_or_equal:date`**  |                                |        |
|     Date after or equal to      |  **`after_or_equal:date`**   |                                |        |
|     File upload validation      |          **`file`**          |                                | ✔️🟰📜 |
|     Image upload validation     |         **`image`**          |     **`is_image[field]`**      | 🚫↪️📜 |
|      MIME types validation      |      **`mimes:types`**       |                                | 🚫↪️📜 |
|      MIME types validation      |    **`mimetypes:types`**     |                                | 🚫↪️📜 |
|    Maximum value constraint     |       **`max:value`**        |                                |        |
|   Image dimension validation    |       **`dimensions`**       |                                |        |
|     Email format validation     |         **`email`**          |       **`valid_email`**        |   ✔️   |
|      URL format validation      |          **`url`**           |        **`valid_url`**         |        |
|      Active URL validation      |       **`active_url`**       |        **`valid_url`**         |        |
|      IP address validation      |           **`ip`**           |                                |        |
|     IPv4 address validation     |          **`ipv4`**          |                                |        |
|     IPv6 address validation     |          **`ipv6`**          |                                |        |
|     MAC address validation      |      **`mac_address`**       |                                |        |
|      Array type validation      |         **`array`**          |                                |        |
|      Value must be in list      |       **`in:values`**        |                                |        |
|    Value must not be in list    |     **`not_in:values`**      |                                |        |
| Ensure all values are distinct  |        **`distinct`**        |                                |        |
|    Unique value in database     |  **`unique:table,column`**   |                                |        |
|       Exists in database        |  **`exists:table,column`**   |                                |        |
|     Confirmation validation     |       **`confirmed`**        |                                |        |
|   Value must be same as field   |       **`same:field`**       |                                |        |
|     Value must be different     |    **`different:field`**     |                                |        |
|   Accepted values validation    |        **`accepted`**        |                                |        |
|     Nullable field presence     |        **`nullable`**        |                                |        |
|     Conditional validation      |       **`sometimes`**        |                                |        |
|     UUID format validation      |          **`uuid`**          |                                |        |
|     JSON format validation      |          **`json`**          |                                |        |
|       Value must end with       |    **`ends_with:value`**     |                                |        |
|      Value must start with      |   **`starts_with:value`**    |                                |        |
|       Value is prohibited       |       **`prohibited`**       |                                |        |
|  Value prohibits another field  |  **`prohibits:otherfield`**  |                                |        |

---

### Code

| rule                                | desc                                                                                                                    |
| ----------------------------------- | ----------------------------------------------------------------------------------------------------------------------- |
| **`required`**:                     | The field must not be empty.                                                                                            |
| **`permit_empty`**:                 | The field is allowed to be empty (used alongside other rules like `valid_email`).                                       |
| **`in_list[list]`**:                | The field value must be one of the values in the provided list (e.g., `in_list[red,blue,green]`).                       |
| **`min_length[value]`**:            | The string must have at least `value` characters (e.g., `min_length[10]`).                                              |
| **`max_length[value]`**:            | The string must not exceed `value` characters (e.g., `max_length[255]`).                                                |
| **`exact_length[value]`**:          | The string must be exactly `value` characters long.                                                                     |
| **`alpha`**:                        | The field may only contain alphabetical characters (A-Z, a-z).                                                          |
| **`alpha_numeric`**:                | The field may only contain alphanumeric characters.                                                                     |
| **`alpha_numeric_space`**:          | The field may contain alphanumeric characters and spaces.                                                               |
| **`alpha_dash`**:                   | The field may contain alphanumeric characters, dashes, underscores.                                                     |
| **`alpha_numeric_punct`**:          | Allows alphanumeric characters, spaces, and the following punctuation: `~!#@$%^&\*()\_-+=                               |
| **`regex_match[pattern]`**:         | The field value must match the regular expression provided (e.g., `regex_match[/^[a-z]+$/]`).                           |
| **`numeric`**:                      | The field must contain only numeric values.                                                                             |
| **`integer`**:                      | The field must contain an integer.                                                                                      |
| **`decimal`**:                      | The field must contain a decimal number.                                                                                |
| **`greater_than[value]`**:          | The field must contain a number greater than `value` (e.g., `greater_than[5]`).                                         |
| **`greater_than_equal_to[value]`**: | The field must contain a number greater than or equal to `value`.                                                       |
| **`less_than[value]`**:             | The field must contain a number less than `value`.                                                                      |
| **`less_than_equal_to[value]`**:    | The field must contain a number less than or equal to `value`.                                                          |
| **`valid_date`**:                   | Ensures that the field contains a valid date format.                                                                    |
| **`valid_date[format]`**:           | Checks that the field matches a specific date format (e.g., `valid_date[Y-m-d]`).                                       |
| **`greater_than_date[field]`**:     | Ensures that the field date is greater than another field's value.                                                      |
| **`less_than_date[field]`**:        | Ensures that the field date is less than another field's value.                                                         |
| **`uploaded[field]`**:              | Ensures a file was uploaded.                                                                                            |
| **`max_size[field,value]`**:        | Ensures the uploaded file is not larger than the specified size (in kilobytes).                                         |
| **`is_image[field]`**:              | Ensures the uploaded file is a valid image.                                                                             |
| **`mime_in[field, mime_types]`**:   | Ensures the uploaded file matches one of the allowed MIME types (e.g., `mime_in[file,image/jpg,image/jpeg,image/gif]`). |
| **`ext_in[field, extensions]`**:    | Ensures the file has one of the allowed extensions (e.g., `ext_in[file,jpg,jpeg,png,gif]`).                             |
| **`valid_email`**:                  | Ensures that the field contains a valid email address.                                                                  |
| **`valid_emails`**:                 | Ensures that the field contains multiple valid email addresses.                                                         |
| **`valid_url`**:                    | Ensures that the field contains a valid URL.                                                                            |
| **`is_unique[table.field]`**:       | Ensures the field value is unique in the specified table and column (e.g., `is_unique[users.email]`).                   |
| **`differs[field]`**:               | Ensures the field is different from another specified field.                                                            |
| **`matches[field]`**:               | Ensures the field matches the value of another specified field (often used with password confirmation).                 |
| **`boolean`**:                      | Ensures that the field contains a boolean value (`true`/`false`, `1`/`0`, or `yes`/`no`).                               |
| **`is_natural`**:                   | Ensures the field contains only natural numbers (0 and positive integers).                                              |
| **`is_natural_no_zero`**:           | Ensures the field contains only natural numbers greater than 0.                                                         |
| **`callback_methodName`**:          | Allows you to call a custom validation method in the controller or model (e.g., `callback_check_date`).                 |

### Laravel

| rule                          | desc                                                                                                                    |
| ----------------------------- | ----------------------------------------------------------------------------------------------------------------------- |
| **`required`**:               | Field must be present and not empty.                                                                                    |
| **`nullable`**:               | Field is allowed to be null.                                                                                            |
| **`filled`**:                 | Field must be present, but can be empty (useful when combined with other conditions).                                   |
| **`present`**:                | Field must be present, even if it’s empty.                                                                              |
| **`min:value`**:              | The field's value must have a minimum length, or be greater than or equal to a given numeric value (depending on type). |
| **`max:value`**:              | Field's value must not exceed a maximum length or value.                                                                |
| **`size:value`**:             | The field must be exactly the given size (applies to string length, array count, or file size).                         |
| **`between:min,max`**:        | Value must be within a specified range of min and max.                                                                  |
| **`string`**:                 | Field must be a string.                                                                                                 |
| **`alpha`**:                  | Field must contain only alphabetic characters.                                                                          |
| **`alpha_num`**:              | Field must contain only alphabetic and numeric characters.                                                              |
| **`alpha_dash`**:             | Field may contain letters, numbers, dashes, and underscores.                                                            |
| **`regex:/pattern/`**:        | Field must match a regular expression pattern.                                                                          |
| **`numeric`**:                | Field must be a number.                                                                                                 |
| **`integer`**:                | Field must be an integer.                                                                                               |
| **`digits:value`**:           | Must be exactly `value` digits long.                                                                                    |
| **`digits_between:min,max`**: | Must be between `min` and `max` digits.                                                                                 |
| **`gt:field`**:               | Must be greater than another field or value.                                                                            |
| **`lt:field`**:               | Must be less than another field or value.                                                                               |
| **`gte:field`**:              | Must be greater than or equal to another field.                                                                         |
| **`lte:field`**:              | Must be less than or equal to another field.                                                                            |
| **`date`**:                   | Field must be a valid date.                                                                                             |
| **`date_format:format`**:     | Must match a specified date format.                                                                                     |
| **`before:date`**:            | Date must be before a given date.                                                                                       |
| **`after:date`**:             | Date must be after a given date.                                                                                        |
| **`before_or_equal:date`**:   | Must be a date before or equal to the given one.                                                                        |
| **`after_or_equal:date`**:    | Must be a date after or equal to the given one.                                                                         |
| **`file`**:                   | Field must be an uploaded file.                                                                                         |
| **`image`**:                  | File must be an image (jpeg, png, bmp, gif, svg, webp).                                                                 |
| **`mimes:types`**:            | File must be of one of the specified MIME types, e.g., `mimes:jpg,bmp,png`.                                             |
| **`mimetypes:types`**:        | File must match a specific set of MIME types.                                                                           |
| **`max:value`**:              | File must not be larger than the specified number of kilobytes.                                                         |
| **`dimensions`**:             | Used for image dimension constraints, like `dimensions:min_width=100,min_height=200`.                                   |
| **`email`**:                  | Field must be a valid email address.                                                                                    |
| **`url`**:                    | Field must be a valid URL.                                                                                              |
| **`active_url`**:             | Field must be a valid, accessible URL.                                                                                  |
| **`ip`**:                     | Must be a valid IP address.                                                                                             |
| **`ipv4`**:                   | Must be a valid IPv4 address.                                                                                           |
| **`ipv6`**:                   | Must be a valid IPv6 address.                                                                                           |
| **`mac_address`**:            | Must be a valid MAC address.                                                                                            |
| **`array`**:                  | Field must be an array.                                                                                                 |
| **`in:values`**:              | The field's value must be one of the provided list of values.                                                           |
| **`not_in:values`**:          | The field's value must _not_ be in the provided list.                                                                   |
| **`distinct`**:               | Ensures no duplicate values in an array.                                                                                |
| **`boolean`**:                | The field must be `true` or `false` (or equivalents like `1/0`, `on/off`).                                              |
| **`unique:table,column`**:    | Field must be unique in a specific database table. Optionally: `unique:table,column,ignore_id`.                         |
| **`exists:table,column`**:    | The field must exist in a specific column in the database.                                                              |
| **`confirmed`**:              | Requires confirmation by checking another field (`password_confirmation` for example).                                  |
| **`same:field`**:             | The value must match the value of another specified field.                                                              |
| **`different:field`**:        | The value must be different from another specified field.                                                               |
| **`accepted`**:               | Must be `yes`, `on`, `1`, or `true` (typically used for agreeing to terms).                                             |
| **`nullable`**:               | Field can be null.                                                                                                      |
| **`sometimes`**:              | Only apply the validation if the field is present.                                                                      |
| **`uuid`**:                   | Field must be a valid UUID.                                                                                             |
| **`json`**:                   | Field must be a valid JSON string.                                                                                      |
| **`ends_with:value`**:        | Field must end with one of the given values.                                                                            |
| **`starts_with:value`**:      | Field must start with one of the given values.                                                                          |
| **`prohibited`**:             | The field must not be present.                                                                                          |
| **`prohibits:otherfield`**:   | Prohibits the presence of another field if this field is present.                                                       |
