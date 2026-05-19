<?php

use Davidmarsmalow\IndonesianPhone\Phone;

it('detects phone number type', function ($input, $expected) {
    expect(Phone::make($input)->type())->toBe($expected);
})->with([
    'mobile number' => ['0812-3456-7890', Phone::TYPE_MOBILE],
    'mobile number with country code' => ['+62 812 3456 7890', Phone::TYPE_MOBILE],
    'fixed line number' => ['(021) 1234 5678', Phone::TYPE_FIXED_LINE],
    'fixed line number with country code' => ['+62 21 1234 5678', Phone::TYPE_FIXED_LINE],
    'invalid number' => ['12345', null],
    'invalid characters with valid mobile length' => ['0812-3456-7890 ABCD', null],
    'invalid country code' => ['+63 812 3456 7890', null],
]);
