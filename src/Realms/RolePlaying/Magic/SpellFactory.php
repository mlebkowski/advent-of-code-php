<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Magic;

use App\Realms\RolePlaying\Magic\Effects\Damage;
use App\Realms\RolePlaying\Magic\Effects\Drain;
use App\Realms\RolePlaying\Magic\Effects\Mana;
use App\Realms\RolePlaying\Magic\Effects\Shield;

final class SpellFactory
{
    public static function all(): iterable
    {
        yield Instant::of('Magic Missile', cost: 53, effect: Damage::of(4));
        yield Instant::of('Drain', cost: 73, effect: Drain::of(heal: 2, damage: 2));
        yield Sorcery::of('Shield', cost: 113, duration: 6, effect: Shield::of(7));
        yield Sorcery::of('Poison', cost: 173, duration: 6, effect: Damage::of(3));
        yield Sorcery::of('Recharge', cost: 229, duration: 5, effect: Mana::of(101));
    }
}
