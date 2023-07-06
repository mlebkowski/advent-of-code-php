<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D12;

final readonly class Pipe
{
    public static function of(int $alpha, int $bravo): self
    {
        return new self($alpha, $bravo);
    }

    private function __construct(public int $alpha, public int $bravo)
    {
    }
}
