<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D15;

final readonly class IngredientSpoons
{
    public static function fromPairs(int $count, Ingredient $ingredient): self
    {
        return new self($count, $ingredient);
    }

    private function __construct(public int $count, public Ingredient $ingredient)
    {
    }

    public function values(): array
    {
        return [
            ['capacity', $this->ingredient->capacity * $this->count],
            ['durability', $this->ingredient->durability * $this->count],
            ['flavor', $this->ingredient->flavor * $this->count],
            ['texture', $this->ingredient->texture * $this->count],
            ['calories', $this->count * $this->ingredient->calories],
        ];
    }
}
