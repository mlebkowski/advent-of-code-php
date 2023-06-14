<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D15;

final readonly class Score
{
    public static function ofAttributes(
        int $capacity,
        int $durability,
        int $flavor,
        int $texture,
        int $calories,
    ): self {
        return new self($capacity * $durability * $flavor * $texture, $calories);
    }

    public function __construct(public int $score, public int $calories)
    {
    }
}
