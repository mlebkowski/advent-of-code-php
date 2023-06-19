<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D21\Fight;

use App\Solutions\Y2015\D21\Character;
use Generator;

final class Fight
{
    public static function ofCharacters(Character $alpha, Character $bravo): Generator
    {
        while ($alpha->isAlive() && $bravo->isAlive()) {
            yield Attack::of($alpha, $bravo);
            [$bravo, $alpha] = [$alpha, $bravo];
        }

        return $alpha->isAlive() ? $alpha : $bravo;
    }
}
