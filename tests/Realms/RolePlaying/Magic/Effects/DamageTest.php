<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Magic\Effects;

use App\Realms\RolePlaying\CharacterMother;
use PHPUnit\Framework\TestCase;

final class DamageTest extends TestCase
{
    public function test damages the opponents(): void
    {
        $caster = CharacterMother::withSpells('player', 10, 10);
        $opponent = CharacterMother::withItems('boss', 10, 'Longsword', 'Splintmail');
        $sut = Damage::of(4);

        $sut->apply($caster, $opponent);

        self::assertSame(10, $caster->hitPoints());
        self::assertSame(6, $opponent->hitPoints());
    }
}
