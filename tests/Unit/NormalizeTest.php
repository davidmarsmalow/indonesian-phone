<?php

use Davidmarsmalow\IndonesianPhone\Phone;

it('normalizes phone number', function ($input, $expected) {
    expect(Phone::make($input)->normalize())->toBe($expected);
})->with([
    ['0812-3456-7890', '6281234567890'],
    ['+62 812 3456 7890', '6281234567890'],
    ['(021) 1234 5678', '622112345678'],
    ['0812-3456-7890 ABCD', '6281234567890'],
]);
