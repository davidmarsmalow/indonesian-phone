<?php

use Davidmarsmalow\IndonesianPhone\Phone;

it('generates whatsapp link', function ($input, $text, $expected) {
    expect(Phone::make($input)->toWhatsappLink($text))->toBe($expected);
})->with([
    [
        '0812-3456-7890',
        '',
        'https://wa.me/6281234567890',
    ],
    [
        '0812-3456-7890',
        'Hello World',
        'https://wa.me/6281234567890?text=Hello+World',
    ],
]);

it('returns null when generating whatsapp link from invalid phone number', function () {
    expect(Phone::make('abc')->toWhatsappLink())->toBeNull();
});