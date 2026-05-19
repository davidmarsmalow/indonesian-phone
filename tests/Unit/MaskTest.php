<?php

use Davidmarsmalow\IndonesianPhone\Phone;

it('masks valid phone numbers', function ($input, $expected) {
    expect(Phone::make($input)->mask())->toBe($expected);
})->with([
    'mobile number' => ['0812-3456-7890', '6281*****7890'],
    'mobile number with country code' => ['+62 812 3456 7890', '6281*****7890'],
    'fixed line number' => ['(021) 1234 5678', '6221****5678'],
]);

it('supports custom visible digits and mask character', function () {
    expect(Phone::make('0812-3456-7890')->mask(5, 4, '#'))->toBe('62812####7890');
});

it('supports unicode mask character', function () {
    expect(Phone::make('0812-3456-7890')->mask(4, 4, '•'))->toBe('6281•••••7890');
});

it('returns null when masking invalid phone numbers', function () {
    expect(Phone::make('0812-3456-7890 ABCD')->mask())->toBeNull();
});

it('throws exception when visible digits are negative', function () {
    Phone::make('0812-3456-7890')->mask(-1);
})->throws(InvalidArgumentException::class);

it('throws exception when mask is not exactly one character', function () {
    Phone::make('0812-3456-7890')->mask(mask: '**');
})->throws(InvalidArgumentException::class);