<?php

use Davidmarsmalow\IndonesianPhone\Phone;

it('validates indonesian phone numbers', function ($input, $expected) {
    expect(Phone::make($input)->isValid())->toBe($expected);
})->with([
    'mobile number' => ['0812-3456-7890', true],
    'country code number' => ['+62 812 3456 7890', true],
    'fixed line number' => ['(021) 1234 5678', true],
    'invalid number' => ['12345', false],
]);

it('validates indonesian phone numbers with strict mode', function ($input, $expected) {
    expect(Phone::make($input)->isValid())->toBe($expected);
})->with([
    'invalid length' => ['0812-3456', false],
    'invalid characters' => ['0812-3456-ABCD', false],
    'invalid characters with valid mobile length' => ['0812-3456-7890 ABCD', false],
    'invalid country code' => ['+63 812 3456 7890', false],
]);
