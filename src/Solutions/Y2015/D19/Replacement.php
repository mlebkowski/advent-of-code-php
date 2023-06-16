<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19;

use Stringable;

final readonly class Replacement implements Stringable
{
    public static function of(string $from, string $to): self
    {
        return new self($from, $to);
    }

    public function __construct(public string $from, public string $to)
    {
    }

    public function __toString(): string
    {
        return "$this->from => $this->to";
    }
}
