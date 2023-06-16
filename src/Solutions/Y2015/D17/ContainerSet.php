<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D17;

use Stringable;

final readonly class ContainerSet implements Stringable
{
    public static function of(array $sizes): self
    {
        return new self(count($sizes), array_sum($sizes));
    }

    public function __construct(public int $count, public int $capacity)
    {
    }

    public function isExpectedCapacity(int $expectedCapacity): bool
    {
        return $this->capacity === $expectedCapacity;
    }

    public function __toString(): string
    {
        return "$this->count containers of $this->capacity liter capacity";
    }
}
