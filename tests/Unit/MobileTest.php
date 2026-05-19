<?php

use Davidmarsmalow\IndonesianPhone\Phone;

it('detects indonesian mobile phone number', function ($input, $expected) {
    expect(Phone::make($input)->isMobile())->toBe($expected);
})->with([
    'mobile number' => ['0812-3456-7890', true],
    'country code number' => ['+62 812 3456 7890', true],
    'fixed line number' => ['(021) 1234 5678', false],
    'invalid number' => ['12345', false],
    'invalid country code' => ['+63 812 3456 7890', false],
    'invalid characters' => ['0812-3456-ABCD', false],
    'invalid characters with valid mobile length' => ['0812-3456-7890 ABCD', false],
    'invalid mobile prefix' => ['0712-3456-7890', false],
    'invalid mobile prefix with country code' => ['+62 712 3456 7890', false],
    'invalid mobile prefix after country code' => ['+62 8012 3456 7890', false],
]);
