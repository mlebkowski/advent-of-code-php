<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D17;

final readonly class Environment
{
    public static function of(int $width, int $height, string $passcode): self
    {
        return new self($width, $height, $passcode);
    }

    private function __construct(public int $width, public int $height, public string $passcode)
    {
    }
}
