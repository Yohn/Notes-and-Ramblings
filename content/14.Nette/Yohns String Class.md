---
created: 2024-10-15T05:12:39-04:00
modified: 2024-10-15T05:32:58-04:00
---

## Derived from Laravels Str:: class

> [!info]+ Laravels Str::class()
> Thank you laravel for help with this! I did copy / paste from their project to build this.
>
> I did not want to download all the packages that come with just the Support package so I broke out the functions I could to make a standalone class
> Here the regex I used to grab the classes from file

#### Code to help generate this note

````php
$cls = file_get_contents(__DIR__.'/Str2.php');

$fnc = '/\/\*\*(.*)\*\/\n\tpublic static function (.*)\((.*)\) : /s';
$fnc = '/function (.*)\((.*)\) \: (.*)/s';

$re = '/function (.*)\((.*)\) \: (.*)/';

preg_match_all($re, $cls, $matches, PREG_SET_ORDER, 0);

// Print the entire match result
//print_r($matches);
unset($matches[0]);
$k = 0;
foreach($matches as $ary){
	echo '| ['.$ary[1].'](<#'.$ary[1].'>) ';
	$k++;
	if($k == 3){
		echo '|'.PHP_EOL;
		$k = 0;
	}
	//echo '['.$ary[1].'](<#'.$ary[1].'>)'.PHP_EOL;
	//echo '## '.$ary[1].PHP_EOL
	//.'```php'.PHP_EOL.'Str::'.str_replace([' : '.$ary[3], 'function '], '', $ary[0]).PHP_EOL.'```'.PHP_EOL
	//.' @return '.$ary[3].PHP_EOL.PHP_EOL;
}
````

| Cls                             | Cls                           | Cls                                                                   |
| ------------------------------- | ----------------------------- | --------------------------------------------------------------------- |
| [afterLast](#afterLast)         | [before](#before)             | [after](#after)                                                       |
| [between](#between)             | [betweenFirst](#betweenFirst) | [beforeLast](#beforeLast)                                             |
| [charAt](#charAt)               | [chopStart](#chopStart)       | [camel](#camel)                                                       |
| [contains](#contains)           | [containsAll](#containsAll)   | [chopEnd](#chopEnd)                                                   |
| [convertCase](#convertCase)     | [deduplicate](#deduplicate)   | [doesntContain](#doesntContain)                                       |
| [excerpt](#excerpt)             | [finish](#finish)             | [endsWith](#endsWith)                                                 |
| [unwrap](#unwrap)               | [is](#is)                     | [wrap](#wrap)                                                         |
| [isUrl](#isUrl)                 | [isUuid](#isUuid)             | [isJson](#isJson)                                                     |
| [length](#length)               | [limit](#limit)               | [kebab](#kebab)                                                       |
| [words](#words)                 | [mask](#mask)                 | [lower](#lower)                                                       |
| [isMatch](#isMatch)             | [numbers](#numbers)           | [match](#match)                                                       |
| [padLeft](#padLeft)             | [padRight](#padRight)         | [padBoth](#padBoth)                                                   |
| [position](#position)           | [random](#random)             | [parseCallback](#parseCallback)                                       |
| [wordCount](#wordCount)         | [ucsplit](#ucsplit)           | [createRandomStringsUsing](#createRandomStringsUsing)                 |
| [wordWrap](#wordWrap)           | [ucfirst](#ucfirst)           | [createRandomStringsNormally](#createRandomStringsNormally)           |
| [lcfirst](#lcfirst)             | [flushCache](#flushCache)     | [createRandomStringsUsingSequence](#createRandomStringsUsingSequence) |
| [toStringOr](#toStringOr)       | [replaceFirst](#replaceFirst) | [repeat](#repeat)                                                     |
| [replaceLast](#replaceLast)     | [replaceEnd](#replaceEnd)     | [replaceStart](#replaceStart)                                         |
| [start](#start)                 | [upper](#upper)               | [reverse](#reverse)                                                   |
| [headline](#headline)           | [apa](#apa)                   | [title](#title)                                                       |
| [snake](#snake)                 | [trim](#trim)                 | [singular](#singular)                                                 |
| [rtrim](#rtrim)                 | [squish](#squish)             | [ltrim](#ltrim)                                                       |
| [studly](#studly)               | [substr](#substr)             | [startsWith](#startsWith)                                             |
| [substrReplace](#substrReplace) | [swap](#swap)                 | [substrCount](#substrCount)                                           |

## after

```php
Str::after($subject, $search)
```

@return string

## afterLast

```php
Str::afterLast($subject, $search)
```

@return string

## before

```php
Str::before($subject, $search)
```

@return string

## beforeLast

```php
Str::beforeLast($subject, $search)
```

@return string

## between

```php
Str::between($subject, $from, $to)
```

@return string

## betweenFirst

```php
Str::betweenFirst($subject, $from, $to)
```

@return string

## camel

```php
Str::camel($value)
```

@return string

## charAt

```php
Str::charAt($subject, $index)
```

@return string|false

## chopStart

```php
Str::chopStart($subject, $needle)
```

@return string

## chopEnd

```php
Str::chopEnd($subject, $needle)
```

@return string

## contains

```php
Str::contains($haystack, $needles, $ignoreCase = false)
```

@return bool

## containsAll

```php
Str::containsAll($haystack, $needles, $ignoreCase = false)
```

@return bool

## doesntContain

```php
Str::doesntContain($haystack, $needles, $ignoreCase = false)
```

@return bool

## convertCase

```php
Str::convertCase(string $string, int $mode = MB_CASE_FOLD, ?string $encoding = 'UTF-8')
```

@return string

## deduplicate

```php
Str::deduplicate(string $string, string $character = ' ')
```

@return string

## endsWith

```php
Str::endsWith($haystack, $needles)
```

@return bool

## excerpt

```php
Str::excerpt($text, $phrase = '', $options = [])
```

@return string|null

## finish

```php
Str::finish($value, $cap)
```

@return string

## wrap

```php
Str::wrap($value, $before, $after = null)
```

@return string

## unwrap

```php
Str::unwrap($value, $before, $after = null)
```

@return string

## is

```php
Str::is($pattern, $value)
```

@return bool

## isJson

```php
Str::isJson($value)
```

@return bool

## isUrl

```php
Str::isUrl($value, array $protocols = [])
```

@return bool

## isUuid

```php
Str::isUuid($value)
```

@return bool

## kebab

```php
Str::kebab($value)
```

@return string

## length

```php
Str::length($value, $encoding = null)
```

@return int

## limit

```php
Str::limit($value, $limit = 100, $end = '...', $preserveWords = false)
```

@return string

## lower

```php
Str::lower($value)
```

@return string

## words

```php
Str::words($value, $words = 100, $end = '...')
```

@return string

## mask

```php
Str::mask($string, $character, $index, $length = null, $encoding = 'UTF-8')
```

@return string

## match

```php
Str::match($pattern, $subject)
```

@return string

## isMatch

```php
Str::isMatch($pattern, $value)
```

@return bool

## numbers

```php
Str::numbers($value)
```

@return string

## padBoth

```php
Str::padBoth($value, $length, $pad = ' ')
```

@return string

## padLeft

```php
Str::padLeft($value, $length, $pad = ' ')
```

@return string

## padRight

```php
Str::padRight($value, $length, $pad = ' ')
```

@return string

## parseCallback

```php
Str::parseCallback($callback, $default = null)
```

@return array

## position

```php
Str::position($haystack, $needle, $offset = 0, $encoding = null)
```

@return int|bool

## random

```php
Str::random($length = 16)
```

@return string

## createRandomStringsUsing

```php
Str::createRandomStringsUsing(?callable $factory = null)
```

@return void

## createRandomStringsUsingSequence

```php
Str::createRandomStringsUsingSequence(array $sequence, $whenMissing = null)
```

@return void

## createRandomStringsNormally

```php
Str::createRandomStringsNormally()
```

@return void

## repeat

```php
Str::repeat(string $string, int $times)
```

@return string

## toStringOr

```php
Str::toStringOr($value, $fallback)
```

@return string

## replaceFirst

```php
Str::replaceFirst($search, $replace, $subject)
```

@return string

## replaceStart

```php
Str::replaceStart($search, $replace, $subject)
```

@return string

## replaceLast

```php
Str::replaceLast($search, $replace, $subject)
```

@return string

## replaceEnd

```php
Str::replaceEnd($search, $replace, $subject)
```

@return string

## reverse

```php
Str::reverse(string $value)
```

@return string

## start

```php
Str::start($value, $prefix)
```

@return string

## upper

```php
Str::upper($value)
```

@return string

## title

```php
Str::title($value)
```

@return string

## headline

```php
Str::headline($value)
```

@return string

## apa

```php
Str::apa($value)
```

@return string

## singular

```php
Str::singular($value)
```

@return string

## snake

```php
Str::snake($value, $delimiter = '_')
```

@return string

## trim

```php
Str::trim($value, $charlist = null)
```

@return string

## ltrim

```php
Str::ltrim($value, $charlist = null)
```

@return string

## rtrim

```php
Str::rtrim($value, $charlist = null)
```

@return string

## squish

```php
Str::squish($value)
```

@return string

## startsWith

```php
Str::startsWith($haystack, $needles)
```

@return bool

## studly

```php
Str::studly($value)
```

@return string

## substr

```php
Str::substr($string, $start, $length = null, $encoding = 'UTF-8')
```

@return string

## substrCount

```php
Str::substrCount($haystack, $needle, $offset = 0, $length = null)
```

@return int

## substrReplace

```php
Str::substrReplace($string, $replace, $offset = 0, $length = null)
```

@return string|array

## swap

```php
Str::swap(array $map, $subject)
```

@return string

## lcfirst

```php
Str::lcfirst($string)
```

@return string

## ucfirst

```php
Str::ucfirst($string)
```

@return string

## ucsplit

```php
Str::ucsplit($string)
```

@return array

## wordCount

```php
Str::wordCount($string, $characters = null)
```

@return int

## wordWrap

```php
Str::wordWrap($string, $characters = 75, $break = "\n", $cutLongWords = false)
```

@return string

## flushCache

```php
Str::flushCache()
```

@return void
