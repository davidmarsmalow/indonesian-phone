<?php

namespace Davidmarsmalow\IndonesianPhone;

use InvalidArgumentException;

class Phone
{
    public const TYPE_MOBILE = 'mobile';
    public const TYPE_FIXED_LINE = 'fixed_line';

    protected string $raw;

    public function __construct(string $value)
    {
        $this->raw = $value;
    }

    public static function make(string $value): static
    {
        return new static($value);
    }

    public function raw(): string
    {
        return $this->raw;
    }

    public function normalize(): string
    {
        $number = preg_replace('/[^0-9]/', '', $this->raw);

        if (str_starts_with($number, '0')) {
            $number = '62' . substr($number, 1);
        }

        return $number;
    }

    public function isValid(): bool
    {
        if ($this->hasInvalidCharacters()) {
            return false;
        }

        return $this->matchesMobile() || $this->matchesFixedLine();
    }

    public function isMobile(): bool
    {
        if ($this->hasInvalidCharacters()) {
            return false;
        }

        return $this->matchesMobile();
    }

    public function isFixedLine(): bool
    {
        if ($this->hasInvalidCharacters()) {
            return false;
        }

        return $this->matchesFixedLine();
    }

    public function type(): ?string
    {
        if ($this->isMobile()) {
            return self::TYPE_MOBILE;
        }

        if ($this->isFixedLine()) {
            return self::TYPE_FIXED_LINE;
        }

        return null;
    }

    public function toE164(): ?string
    {
        if (! $this->isValid()) {
            return null;
        }

        return '+' . $this->normalize();
    }

    public function mask(int $visibleStart = 4, int $visibleEnd = 4, string $mask = '*'): ?string
    {
        if ($visibleStart < 0 || $visibleEnd < 0) {
            throw new InvalidArgumentException('Visible digits must be greater than or equal to zero.');
        }

        if (mb_strlen($mask) !== 1) {
            throw new InvalidArgumentException('Mask must be exactly one character.');
        }

        if (! $this->isValid()) {
            return null;
        }

        $number = $this->normalize();
        $length = mb_strlen($number);

        $maskedLength = $length - ($visibleStart + $visibleEnd);

        if ($maskedLength <= 0) {
            return $number;
        }

        $maskedSection = str_repeat($mask, $maskedLength);

        return mb_substr($number, 0, $visibleStart) . $maskedSection . mb_substr($number, -$visibleEnd);
    }

    private function hasInvalidCharacters(): bool
    {
        return preg_match('/^\+?[0-9\s().-]+$/', $this->raw) !== 1;
    }

    private function matchesMobile(): bool
    {
        return preg_match('/^628[1-9][0-9]{7,10}$/', $this->normalize()) === 1;
    }

    private function matchesFixedLine(): bool
    {
        return preg_match('/^62[2-79][0-9]{8,9}$/', $this->normalize()) === 1;
    }
}
