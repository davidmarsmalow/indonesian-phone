<?php

use Davidmarsmalow\IndonesianPhone\Phone;

it('keeps the raw phone number value', function ($input, $expected) {
    expect(Phone::make($input)->raw())->toBe($expected);
})->with([
    ['0812-3456-7890', '0812-3456-7890'],
    ['+62 812 3456 7890', '+62 812 3456 7890'],
    ['(021) 1234 5678', '(021) 1234 5678'],
]);