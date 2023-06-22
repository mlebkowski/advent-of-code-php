<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Combat;

use App\Realms\RolePlaying\Character;
use App\Realms\RolePlaying\Magic\Sorcery;
use Generator;
use loophp\collection\Collection;

final class Combat
{
    /** @return Generator<int,Turn> */
    public static function ofCharacters(Character $alpha, Character $bravo, ?Sorcery $permanentEffect = null): Generator
    {
        $activeSpells = ActiveSpells::none();
        if ($permanentEffect) {
            $activeSpells->add($bravo, $permanentEffect);
        }

        while (true) {
            $spellEffects = Collection::fromIterable($activeSpells->apply($alpha, $bravo))->all();

            if ($alpha->isDead() || $bravo->isDead()) {
                yield Turn::winning($bravo, $alpha, ...$spellEffects);
                break;
            }

            $attack = self::performAttack($activeSpells, $alpha, $bravo);

            yield Turn::of($attack, ...$spellEffects);

            [$bravo, $alpha] = [$alpha, $bravo];
        }

        return $alpha->isAlive() ? $alpha : $bravo;
    }

    private static function performAttack(ActiveSpells $spells, Character $attacker, Character $defender)
    {
        if ($attacker->attack) {
            return PhysicalAttack::of($attacker, $defender);
        }

        return MagicalAttack::of($spells, $attacker, $defender);
    }
}
