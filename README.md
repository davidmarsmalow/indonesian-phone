# Indonesian Phone

[![Latest Version on Packagist](https://img.shields.io/packagist/v/davidmarsmalow/indonesian-phone.svg)](https://packagist.org/packages/davidmarsmalow/indonesian-phone)
[![Total Downloads](https://img.shields.io/packagist/dt/davidmarsmalow/indonesian-phone.svg)](https://packagist.org/packages/davidmarsmalow/indonesian-phone)
[![License](https://img.shields.io/packagist/l/davidmarsmalow/indonesian-phone.svg)](https://packagist.org/packages/davidmarsmalow/indonesian-phone)

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

## WhatsApp Link

Generate WhatsApp links directly from Indonesian phone numbers.

```php
use Davidmarsmalow\IndonesianPhone\Phone;

Phone::make('0812-3456-7890')->toWhatsappLink();

// https://wa.me/6281234567890
```

### With Prefilled Message

```php
Phone::make('0812-3456-7890')
    ->toWhatsappLink('Hello World');

// https://wa.me/6281234567890?text=Hello+World
```

### Invalid Number

Returns `null` when the phone number is invalid.

```php
Phone::make('abc')->toWhatsappLink();

// null
```


## Masking

`mask()` returns a masked normalized phone number when valid, or `null` when invalid`.

```php
Phone::make('0812-3456-7890')->mask(); // 6281*****7890
Phone::make('(021) 1234 5678')->mask(); // 6221****5678
Phone::make('12345')->mask(); // null
```

You can customize the visible digits and mask character.

```php
Phone::make('0812-3456-7890')->mask(5, 4, '#'); // 62812####7890
Phone::make('0812-3456-7890')->mask(4, 4, '•'); // 6281•••••7890
Phone::make('0812-3456-7890')->mask(4, 4, '🔒'); // 6281🔒🔒🔒🔒🔒7890
```

You can also use emoji as the mask character because why not.

The mask character must be exactly one character. Unicode and emoji mask characters are supported through PHP's `mbstring` extension.

## Testing

```bash
composer test
```
