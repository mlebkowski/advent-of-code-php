<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D16\DanceMoves;

final readonly class Spin implements DanceMove
{
    public static function of(int $size): self
    {
        return new self($size);
    }

    private function __construct(private int $size)
    {
    }

    public function apply(array $programs): array
    {
        return [...array_slice($programs, -$this->size), ...array_slice($programs, 0, -$this->size)];
    }
}
