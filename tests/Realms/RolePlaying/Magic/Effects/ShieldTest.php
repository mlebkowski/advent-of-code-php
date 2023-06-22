<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Magic\Effects;

use App\Realms\RolePlaying\CharacterMother;
use PHPUnit\Framework\TestCase;

final class ShieldTest extends TestCase
{
    public function test(): void
    {
        $character = CharacterMother::withItems('player', 10, 'Dagger', 'Leather');
        self::assertSame(1, $character->armor());

        $sut = Shield::of(5);
        $cleanup = $sut->apply($character, 0);
        self::assertSame(6, $character->armor());
        $cleanup->apply();
        self::assertSame(1, $character->armor());
    }
}
