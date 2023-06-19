<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D21;

final readonly class Item
{
    public static function of(string $name, int $damage, int $armor): self
    {
        return new self($name, $damage, $armor);
    }

    private function __construct(public string $name, public int $damage, public int $armor)
    {
    }
}
