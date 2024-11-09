---
link: https://doc.nette.org/en/utils/strings
byline: David Grudl; https://davidgrudl.com
site: Nette Documentation
date:
updated:
type:
excerpt: Nette\Utils\Strings is a static class, which contains many useful functions for working with UTF-8 encoded strings.
twitter: https://twitter.com/@nettefw
tags: []
onion:
slurped: 2024-10-15T00:16
title: String Functions
modified: 2024-10-15T05:32:32-04:00
---

[Nette\Utils\Strings](https://api.nette.org/utils/master/Nette/Utils/Strings.html) is a static class, which contains many useful functions for working with UTF-8 encoded strings.

Installation:

```sh
composer require nette/utils
```

All examples assume the following class alias is defined:

```php
use Nette\Utils\Strings;
```

## Letter Case

These functions require the PHP extension `mbstring`.

### lower

##### (_string_ $s): _string_

Converts all characters of UTF-8 string to lower case.

```php
Strings::lower('Hello world'); // 'hello world'
```

### upper

##### (_string_ $s): _string_

Converts all characters of a UTF-8 string to upper case.

```php
Strings::upper('Hello world'); // 'HELLO WORLD'
```

### firstUpper

##### (_string_ $s): _string_

Converts the first character of a UTF-8 string to upper case and leaves the other characters unchanged.

```php
Strings::firstUpper('hello world'); // 'Hello world'
```

### firstLower

##### (_string_ $s): _string_

Converts the first character of a UTF-8 string to lower case and leaves the other characters unchanged.

```php
Strings::firstLower('Hello world'); // 'hello world'
```

### capitalize

##### (_string_ $s): _string_

Converts the first character of every word of a UTF-8 string to upper case and the others to lower case.

```php
Strings::capitalize('Hello world'); // 'Hello World'
```

## Editing a String

### normalize

##### (_string_ $s): _string_

Removes control characters, normalizes line breaks to `\n`, removes leading and trailing blank lines, trims end spaces on lines, normalizes UTF-8 to the normal form of NFC.

### unixNewLines

##### (_string_ $s): _string_

Converts line breaks to `\n` used on Unix systems. The line breaks are: `\n`, `\r`, `\r\n`, U+2028 line separator, U+2029 paragraph separator.

```php
$unixLikeLines = Strings::unixNewLines($string);
```

### platformNewLines

##### (_string_ $s): *string*

Converts line breaks to characters specific to the current platform, i.e. `\r\n` on Windows and `\n` elsewhere. The line breaks are `\n`, `\r`, `\r\n`, U+2028 line separator, U+2029 paragraph separator.

```php
$platformLines = Strings::platformNewLines($string);
```

### webalize

##### (_string_ $s, _string_ $charlist=null, _bool_ $lower=true): *string*

Modifies the UTF-8 string to the form used in the URL, ie removes diacritics and replaces all characters except letters of the English alphabet and numbers with a hyphens.

````php
Strings::webalize('žluťoučký kůň'); // 'zlutoucky-kun'
```php

Other characters may be preserved as well, but they must be passed as second argument.

```php
Strings::webalize('10. image_id', '._'); // '10.-image_id'
```php

The third argument may suppress converting the string to lower case.

```php
Strings::webalize('Hello world', null, false); // 'Hello-world'
````

Requires PHP extension `intl`.

### trim

##### (_string_ $s, _string_ $charlist=null): *string*

Removes all left and right side spaces (or the characters passed as second argument) from a UTF-8 encoded string.

```php
Strings::trim('  Hello  '); // 'Hello'
```

### truncate

##### (_string_ $s, _int_ $maxLen, _string_ $append=`` `'…' ```): *string*

Truncates a UTF-8 string to given maximal length, while trying not to split whole words. Only if the string is truncated, an ellipsis (or something else set with third argument) is appended to the string.

```php
$text = 'Hello, how are you today?';
Strings::truncate($text, 5);       // 'Hell…'
Strings::truncate($text, 20);      // 'Hello, how are you…'
Strings::truncate($text, 30);      // 'Hello, how are you today?'
Strings::truncate($text, 20, '~'); // 'Hello, how are you~'
```

### indent

##### (_string_ $s, _int_ $level=1, _string_ $indentationChar=`` `"\t" ```): *string*

Indents a multiline text from the left. Second argument sets how many indentation chars should be used, while the indent itself is the third argument (_tab_ by default).

```php
Strings::indent('Nette');         // "\tNette"
Strings::indent('Nette', 2, '+'); // '++Nette'
```

### padLeft

##### (_string_ $s, _int_ $length, _string_ $pad=`` `' ' ```): *string*

Pads a UTF-8 string to given length by prepending the `$pad` string to the beginning.

```php
Strings::padLeft('Nette', 6);        // ' Nette'
Strings::padLeft('Nette', 8, '+*');  // '+*+Nette'
```

### padRight

##### (_string_ $s, _int_ $length, _string_ $pad=`` `' ' ```): *string*

Pads UTF-8 string to given length by appending the `$pad` string to the end.

```php
Strings::padRight('Nette', 6);       // 'Nette '
Strings::padRight('Nette', 8, '+*'); // 'Nette+*+'
```

### substring

##### (_string_ $s, _int_ $start, _int_ $length=null): *string*

Returns a part of UTF-8 string specified by starting position `$start` and length `$length`. If `$start` is negative, the returned string will start at the `$start`'th character from the end of string.

```php
Strings::substring('Nette Framework', 0, 5); // 'Nette'
Strings::substring('Nette Framework', 6);    // 'Framework'
Strings::substring('Nette Framework', -4);   // 'work'
```

### reverse

##### (_string_ $s): _string_

Reverses UTF-8 string.

```php
Strings::reverse('Nette'); // 'etteN'
```

### length

##### (_string_ $s): _int_

Returns number of characters (not bytes) in UTF-8 string.

That is the number of Unicode code points which may differ from the number of graphemes.

```php
Strings::length('Nette'); // 5
Strings::length('red');   // 3
```

### startsWith

##### (_string_ $haystack, _string_ $needle): *bool*

Checks if `$haystack` string begins with `$needle`.

```php
$haystack = 'Begins';
$needle = 'Be';
Strings::startsWith($haystack, $needle); // true
```

Use native [`str_starts_with()`](https://www.php.net/manual/en/function.str-starts-with.php).

### endsWith

##### (_string_ $haystack, _string_ $needle): *bool*

Checks if `$haystack` string end with `$needle`.

```php
$haystack = 'Ends';
$needle = 'ds';
Strings::endsWith($haystack, $needle); // true
```

Use native [`str_ends_with()`](https://www.php.net/manual/en/function.str-ends-with.php).

### contains

##### (_string_ $haystack, _string_ $needle): *bool*

Checks if `$haystack` string contains `$needle`.

```php
$haystack = 'Contains';
$needle = 'tai';
Strings::contains($haystack, $needle); // true
```

Use native [`str_contains()`](https://www.php.net/manual/en/function.str-contains.php).

### compare

##### (_string_ $left, _string_ $right, _int_ $length=null): *bool*

Compares two UTF-8 strings or their parts, without taking character case into account. If `$length` is null, whole strings are compared, if it is negative, the corresponding number of characters from the end of the strings is compared, otherwise the appropriate number of characters from the beginning is compared.

```php
Strings::compare('Nette', 'nette');     // true
Strings::compare('Nette', 'next', 2);   // true - two first characters match
Strings::compare('Nette', 'Latte', -2); // true - two last characters match
```

### findPrefix

##### (…$strings): _string_

Finds the common prefix of strings or returns empty string if the prefix was not found.

```php
Strings::findPrefix('prefix-a', 'prefix-bb', 'prefix-c');   // 'prefix-'
Strings::findPrefix(['prefix-a', 'prefix-bb', 'prefix-c']); // 'prefix-'
Strings::findPrefix('Nette', 'is', 'great');                // ''
```

### before

##### (_string_ $haystack, _string_ $needle, _int_ $nth=1): _?string_

Returns part of `$haystack` before `$nth` occurence of `$needle` or returns `null` if the needle was not found. Negative value means searching from the end.

```php
Strings::before('Nette_is_great', '_', 1);  // 'Nette'
Strings::before('Nette_is_great', '_', -2); // 'Nette'
Strings::before('Nette_is_great', ' ');     // null
Strings::before('Nette_is_great', '_', 3);  // null
```

### after

##### (_string_ $haystack, _string_ $needle, _int_ $nth=1): _?string_

Returns part of `$haystack` after `$nth` occurence of `$needle` or returns `null` if the `$needle` was not found. Negative value of `$nth` means searching from the end.

```php
Strings::after('Nette_is_great', '_', 2);  // 'great'
Strings::after('Nette_is_great', '_', -1); // 'great'
Strings::after('Nette_is_great', ' ');     // null
Strings::after('Nette_is_great', '_', 3);  // null
```

### indexOf

##### (_string_ $haystack, _string_ $needle, _int_ $nth=1): *?int*

Returns position in characters of `$nth` occurence of `$needle` in `$haystack` or `null` if the `$needle` was not found. Negative value of `$nth` means searching from the end.

```php
Strings::indexOf('abc abc abc', 'abc', 2);  // 4
Strings::indexOf('abc abc abc', 'abc', -1); // 8
Strings::indexOf('abc abc abc', 'd');       // null
```

## Encoding

### fixEncoding

##### (_string_ $s): _string_

Removes all invalid UTF-8 characters from a string.

```php
$correctStrings = Strings::fixEncoding($string);
```

### checkEncoding

##### (_string_ $s): *bool*

Checks if the string is valid in UTF-8 encoding.

```php
$isUtf8 = Strings::checkEncoding($string);
```

Use [Nette\Utils\Validator::isUnicode()](https://doc.nette.org/en/utils/validators#toc-isunicode).

### toAscii

##### (_string_ $s): _string_

Converts UTF-8 string to ASCII, ie removes diacritics etc.

```php
Strings::toAscii('žluťoučký kůň'); // 'zlutoucky kun'
```

Requires PHP extension `intl`.

### chr

##### (_int_ $code): _string_

Returns a specific character in UTF-8 from code point (number in range 0×0000..D7FF or 0xE000..10FFFF).

```php
Strings::chr(0xA9); // '©'
```

### ord

##### (_string_ $char): _int_

Returns a code point of specific character in UTF-8 (number in range 0×0000..D7FF or 0xE000..10FFFF).

```php
Strings::ord('©'); // 0xA9
```

## Regular Expressions

The Strings class provides functions for working with regular expressions. Unlike native PHP functions, they have a more understandable API, better Unicode support, and most importantly, error detection. Any compilation or expression processing error will throw a `Nette\RegexpException` exception.

### split

##### (_string_ $subject, _string_ $pattern, _bool_ $captureOffset=false, _bool_ $skipEmpty=false, _int_ $limit=-1, _bool_ $utf8=false): *array*

Divides the string into arrays according to the regular expression. Expressions in parentheses will be captured and returned as well.

```php
Strings::split('hello, world', '~,\s*~');
// ['hello', 'world']

Strings::split('hello, world', '~(,)\s*~');
// ['hello', ',', 'world']``
```

If `$skipEmpty` is `true`, only non-empty items will be returned:

```php
Strings::split('hello, world, ', '~,\s*~');
// ['hello', 'world', '']

Strings::split('hello, world, ', '~,\s*~', skipEmpty: true);
// ['hello', 'world']
```

If `$limit` is specified, only substrings up to the limit will be returned and the rest of the string will be placed in the last element. A limit of –1 or 0 means no limit.

```php
Strings::split('hello, world, third', '~,\s*~', limit: 2);
// ['hello', 'world, third']
```

If `$utf8` is `true`, the evaluation switches to Unicode mode. This is similar to specifying the `u` modifier.

If `$captureOffset` is `true`, for each occurring match, its position in the string will also be returned (in bytes; in characters if `$utf8` is set). This changes the return value to an array where each element is a pair consisting of the matched string and its position.

```php
Strings::split('žlutý, kůň', '~,\s*~', captureOffset: true);
// [['žlutý', 0], ['kůň', 9]]

Strings::split('žlutý, kůň', '~,\s*~', captureOffset: true, utf8: true);
// [['žlutý', 0], ['kůň', 7]]
```

### match

##### (_string_ $subject, _string_ $pattern, _bool_ $captureOffset=false, _int_ $offset=0, _bool_ $unmatchedAsNull=false, _bool_ $utf8=false): *?array*

Searches the string for the part matching the regular expression and returns an array with the found expression and individual subexpressions, or `null`.

```php
Strings::match('hello!', '~\w+(!+)~');
// ['hello!', '!']

Strings::match('hello!', '~X~');
// null
```

If `$unmatchedAsNull` is `true`, unmatched subpatterns are returned as null; otherwise they are returned as an empty string or not returned:

```php
Strings::match('hello', '~\w+(!+)?~');
// ['hello']

Strings::match('hello', '~\w+(!+)?~', unmatchedAsNull: true);
// ['hello', null]
```

If `$utf8` is `true`, the evaluation switches to Unicode mode. This is similar to specifying the `u` modifier:

```php
Strings::match('žlutý kůň', '~\w+~');
// ['lut']

Strings::match('žlutý kůň', '~\w+~', utf8: true);
// ['žlutý']
```

The `$offset` parameter can be used to specify the position from which to start the search (in bytes; in characters if `$utf8` is set).

If `$captureOffset` is `true`, for each occurring match, its position in the string will also be returned (in bytes; in characters if `$utf8` is set). This changes the return value to an array where each element is a pair consisting of the matched string and its offset:

```php
Strings::match('žlutý!', '~\w+(!+)?~', captureOffset: true);
// [['lut', 2]]

Strings::match('žlutý!', '~\w+(!+)?~', captureOffset: true, utf8: true);
// [['žlutý!', 0], ['!', 5]]
```

### matchAll

##### (_string_ $subject, _string_ $pattern, _bool_ $captureOffset=false, _int_ $offset=0, _bool_ $unmatchedAsNull=false, _bool_ $patternOrder=false, _bool_ $utf8=false, _bool_ $lazy=false): _array|Generator_

Searches the string for all occurrences matching the regular expression and returns an array of arrays containing the found expression and each subexpression.

```php
Strings::matchAll('hello, world!!', '~\w+(!+)?~');
/* [
	0 => ['hello'],
	1 => ['world!!', '!!'],
] */
```

If `$patternOrder` is `true`, the structure of the results changes so that the first item is an array of full pattern matches, the second is an array of strings corresponding to the first subpattern in parentheses, and so on:

```php
Strings::matchAll('hello, world!!', '~\w+(!+)?~', patternOrder: true);
/* [
	0 => ['hello', 'world!!'],
	1 => ['', '!!'],
] */
```

If `$unmatchedAsNull` is `true`, unmatched subpatterns are returned as null; otherwise they are returned as an empty string or not returned:

```php
Strings::matchAll('hello, world!!', '~\w+(!+)?~', unmatchedAsNull: true);
/* [
	0 => ['hello', null],
	1 => ['world!!', '!!'],
] */
```

If `$utf8` is `true`, the evaluation switches to Unicode mode. This is similar to specifying the `u` modifier:

```php
Strings::matchAll('žlutý kůň', '~\w+~');
/* [
	0 => ['lut'],
	1 => ['k'],
] */

Strings::matchAll('žlutý kůň', '~\w+~', utf8: true);
/* [
	0 => ['žlutý'],
	1 => ['kůň'],
] */
```

The `$offset` parameter can be used to specify the position from which to start the search (in bytes; in characters if `$utf8` is set).

If `$captureOffset` is `true`, for each occurring match, its position in the string will also be returned (in bytes; in characters if `$utf8` is set). This changes the return value to an array where each element is a pair consisting of the matched string and its position:

```php
Strings::matchAll('žlutý kůň', '~\w+~', captureOffset: true);
/* [
	0 => [['lut', 2]],
	1 => [['k', 8]],
] */

Strings::matchAll('žlutý kůň', '~\w+~', captureOffset: true, utf8: true);
/* [
	0 => [['žlutý', 0]],
	1 => [['kůň', 6]],
] */
```

If `$lazy` is `true`, the function returns a `Generator` instead of an array, which provides significant performance benefits when working with large strings. The generator allows for matches to be found incrementally, rather than processing the entire string at once. This enables efficient handling of extremely large input texts. Additionally, you can interrupt processing at any time if you find the desired match, saving computational time.

```php
$matches = Strings::matchAll($largeText, '~\w+~', lazy: true);
foreach ($matches as $match) {
    echo "Found: $match[0]\n";
    // Processing can be interrupted at any time
}
```

### replace

##### (_string_ $subject, _string|array_ $pattern, _string|callable_ $replacement=`''`, _int_ $limit=-1, _bool_ $captureOffset=false, _bool_ $unmatchedAsNull=false, _bool_ $utf8=false): *string*

Replaces all occurrences matching the regular expression. The `$replacement` is either a replacement string mask or a callback.

```php
Strings::replace('hello, world!', '~\w+~', '--');
// '--, --!'

Strings::replace('hello, world!', '~\w+~', fn($m) => strrev($m[0]));
// 'olleh, dlrow!'
```

The function also allows multiple replacements by passing an array of the form `pattern => replacement` in the second parameter:

```php
Strings::replace('hello, world!', [
	'~\w+~' => '--',
	'~,\s+~' => ' ',
]);
// '-- --!'
```

The `$limit` parameter limits the number of substitutions. Limit –1 means no limit.

If `$utf8` is `true`, the evaluation switches to Unicode mode. This is similar to specifying the `u` modifier.

```php
Strings::replace('žlutý kůň', '~\w+~', '--');
// 'ž--ý --ůň'

Strings::replace('žlutý kůň', '~\w+~', '--', utf8: true);
// '-- --'
```

If `$captureOffset` is `true`, for each occurring match, its position in the string (in bytes; in characters if `$utf8` is set) is also passed to the callback. This changes the form of the passed array, where each element is a pair consisting of the matched string and its position.

```php
Strings::replace(
	'žlutý kůň',
	'~\w+~',
	function (array $m) { dump($m); return ''; },
	captureOffset: true,
);
// dumps [['lut', 2]] a [['k', 8]]

Strings::replace(
	'žlutý kůň',
	'~\w+~',
	function (array $m) { dump($m); return ''; },
	captureOffset: true,
	utf8: true,
);
// dumps [['žlutý', 0]] a [['kůň', 6]]
```

If `$unmatchedAsNull` is `true`, unmatched subpatterns are passed to the callback as null; otherwise they are passed as an empty string or not passed:

```php
Strings::replace(
	'ac',
	'~(a)(b)*(c)~',
	function (array $m) { dump($m); return ''; },
);
// dumps ['ac', 'a', '', 'c']

Strings::replace(
	'ac',
	'~(a)(b)*(c)~',
	function (array $m) { dump($m); return ''; },
	unmatchedAsNull: true,
);
// dumps ['ac', 'a', null, 'c']
```
