<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D20;

use Generator;

final readonly class Houses
{
    public static function upTo(int $max): self
    {
        return new self($max);
    }

    public function __construct(private int $max)
    {
    }

    public function visit(int $elf, int $upTo = PHP_INT_MAX): Generator
    {
        $houseNumber = 0;
        $count = 0;
        while (($houseNumber += $elf) <= $this->max && ($count++) < $upTo) {
            yield $houseNumber;
        }
    }

}
