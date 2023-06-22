<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Combat;

use App\Realms\RolePlaying\CharacterMother;
use App\Realms\RolePlaying\Magic\Effects\Damage;
use App\Realms\RolePlaying\Magic\Sorcery;
use PHPUnit\Framework\TestCase;

final class ActiveSpellTest extends TestCase
{
    public function test is exhausted(): void
    {
        $sut = ActiveSpell::of(
            Sorcery::of('Whatever', cost: 1, duration: 1, effect: Damage::of(1)),
            CharacterMother::some(),
        );

        self::assertFalse($sut->isExhausted());
        iterator_to_array($sut->apply());
        self::assertTrue($sut->isExhausted());
    }
}
