<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D22;

enum InfectionState: string
{
    case Infected = "#";
    case Clean = '.';

    public function turn(): self
    {
        return match ($this) {
            self::Infected => self::Clean,
            self::Clean => self::Infected,
        };
    }
}
