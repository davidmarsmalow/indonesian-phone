# Indonesian Phone

Indonesian phone number toolkit for PHP.

## Installation

```bash
composer require davidmarsmalow/indonesian-phone
```

## Usage

```php
use Davidmarsmalow\IndonesianPhone\Phone;

$phone = Phone::make('0812-3456-7890');

$phone->raw(); // 0812-3456-7890
$phone->normalize(); // 6281234567890
$phone->isValid();  // true
$phone->isMobile(); // true
$phone->isFixedLine(); // false
$phone->type(); // mobile
$phone->toE164(); // +6281234567890
```

## Raw Value

`raw()` returns the original value passed to `Phone::make()`.

```php
Phone::make('0812-3456-7890')->raw(); // 0812-3456-7890
```

## Normalization

`normalize()` removes non-numeric characters and converts local Indonesian numbers that start with `0` into country-code format.

```php
Phone::make('0812-3456-7890')->normalize(); // 6281234567890
Phone::make('+62 812 3456 7890')->normalize(); // 6281234567890
Phone::make('(021) 1234 5678')->normalize(); // 622112345678
```

## Validation

`isValid()` returns `true` when the number is recognized as either a mobile or fixed-line Indonesian phone number.

```php
Phone::make('0812-3456-7890')->isValid(); // true
Phone::make('(021) 1234 5678')->isValid(); // true
Phone::make('12345')->isValid(); // false
```

Use `isMobile()` when you only want to accept Indonesian mobile numbers.

```php
Phone::make('0812-3456-7890')->isMobile(); // true
Phone::make('(021) 1234 5678')->isMobile(); // false
```

Use `isFixedLine()` when you only want to accept Indonesian fixed-line numbers.

```php
Phone::make('(021) 1234 5678')->isFixedLine(); // true
Phone::make('0812-3456-7890')->isFixedLine(); // false
```

## Type Detection

`type()` returns the detected phone number type, or `null` when the number is invalid or unrecognized.

```php
Phone::make('0812-3456-7890')->type(); // mobile
Phone::make('(021) 1234 5678')->type(); // fixed_line
Phone::make('12345')->type(); // null
```

You can compare the result using the provided constants.

```php
Phone::TYPE_MOBILE; // mobile
Phone::TYPE_FIXED_LINE; // fixed_line
```

## E.164 Format

`toE164()` returns the phone number in E.164 format when valid, or `null` when invalid.

```php
Phone::make('0812-3456-7890')->toE164(); // +6281234567890
Phone::make('(021) 1234 5678')->toE164(); // +622112345678
Phone::make('12345')->toE164(); // null
```

## Testing

```bash
composer test
```
