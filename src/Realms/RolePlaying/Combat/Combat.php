<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Combat;

use App\Realms\RolePlaying\Character;
use App\Realms\RolePlaying\Magic\Instant;
use App\Realms\RolePlaying\Magic\Problems\NotEnoughMana;
use App\Realms\RolePlaying\Magic\Sorcery;
use Generator;

final class Combat
{
    public static function ofCharacters(Character $alpha, Character $bravo): Generator
    {
        $activeSpells = ActiveSpells::none();

        while ($alpha->isAlive() && $bravo->isAlive()) {
            $activeSpells->apply($alpha, $bravo);

            try {
                $attack = $alpha->performAttack($bravo);
            } catch (NotEnoughMana) {
                $alpha->kill();
                return $bravo;
            }

            if ($attack instanceof Sorcery) {
                $activeSpells->add($alpha, $attack);
            } elseif ($attack instanceof Instant) {
                $attack->effect->apply($alpha, $bravo);
            }

            yield $attack;

            [$bravo, $alpha] = [$alpha, $bravo];
        }

        return $alpha->isAlive() ? $alpha : $bravo;
    }
}
