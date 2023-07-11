<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D01;

final readonly class Loop
{
    public static function of(int $index, int $length): self
    {
        return new self($index, $length);
    }

    private function __construct(public int $index, public int $length)
    {

    }
}
