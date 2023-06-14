<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D15;

final readonly class Ingredient
{
    public function __construct(
        public int $capacity,
        public int $durability,
        public int $flavor,
        public int $texture,
        public int $calories,
    ) {
    }
}
