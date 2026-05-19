<?php

use Davidmarsmalow\IndonesianPhone\Phone;

it('detects indonesian fixed line number', function ($input, $expected) {
    expect(Phone::make($input)->isFixedLine())->toBe($expected);
})->with([
    'mobile number' => ['0812-3456-7890', false],
    'country code number' => ['+62 812 3456 7890', false],
    'fixed line number' => ['(021) 1234 5678', true],
    'fixed line with country code' => ['+62 21 1234 5678', true],
    'fixed line with area code' => ['031-1234-5678', true],
    'fixed line with area code and country code' => ['+62 24 1234 5678', true],
    'invalid characters with valid fixed line length' => ['(021) 1234 5678 ABCD', false],
]);
