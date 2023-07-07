<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D16\DanceMoves;

final readonly class Exchange implements DanceMove
{
    public static function of(int $alpha, int $bravo): self
    {
        return new self($alpha, $bravo);
    }

    private function __construct(private int $alpha, private int $bravo)
    {
    }

    public function apply(array $programs): array
    {
        $result = $programs;
        $result[$this->bravo] = $programs[$this->alpha];
        $result[$this->alpha] = $programs[$this->bravo];
        return $result;
    }
}
