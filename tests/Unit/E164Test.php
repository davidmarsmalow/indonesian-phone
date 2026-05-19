<?php

use Davidmarsmalow\IndonesianPhone\Phone;

it('formats phone number to E.164 format', function ($input, $expected) {
    expect(Phone::make($input)->toE164())->toBe($expected);
})->with([
    ['0812-3456-7890', '+6281234567890'],
    ['+62 812 3456 7890', '+6281234567890'],
    ['(021) 1234 5678', '+622112345678'],
]);

it('returns null for invalid phone numbers', function () {
    expect(Phone::make('12345')->toE164())->toBeNull();
});
