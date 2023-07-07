<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D16\DanceMoves;

final readonly class Partner implements DanceMove
{
    public static function of(string $alpha, string $bravo): self
    {
        return new self($alpha, $bravo);
    }

    private function __construct(private string $alpha, private string $bravo)
    {
    }

    public function apply(array $programs): array
    {
        $alpha = array_search($this->alpha, $programs, true);
        $bravo = array_search($this->bravo, $programs, true);
        return Exchange::of($alpha, $bravo)->apply($programs);
    }
}
