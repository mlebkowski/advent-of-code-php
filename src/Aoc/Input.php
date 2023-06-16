<?php

declare(strict_types=1);

namespace App\Aoc;

final readonly class Input
{
    public static function of(false|string $input, false|string $sample, false|string $expected): self
    {
        return new self((string)$input, (string)$sample, trim((string)$expected));
    }

    public function __construct(public string $actual, public string $sample, public string $expected)
    {
    }
}
