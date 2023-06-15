<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D15;

final readonly class IngredientsInput
{
    /** @var Ingredient[] */
    public array $ingredients;

    public static function of(Ingredient ...$ingredients): self
    {
        return new self(...$ingredients);
    }

    private function __construct(Ingredient ...$ingredients)
    {
        $this->ingredients = $ingredients;
    }
}
