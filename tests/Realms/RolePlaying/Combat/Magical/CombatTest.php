<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Combat\Magical;

use App\Realms\RolePlaying\CharacterMother;
use App\Realms\RolePlaying\Combat\Combat;
use PHPUnit\Framework\TestCase;

final class CombatTest extends TestCase
{
    public function test cleanup is performed(): void
    {
        $startingHitPoints = 100;
        $turns = 10;
        $shieldProtection = 3;
        $expectedDamage = ($shieldProtection * 1) + (($turns - $shieldProtection) * 8);

        $player = CharacterMother::withSpells(
            'player',
            $startingHitPoints,
            $turns * 113,
            'Shield',
            'Magic Missile',
            'Magic Missile',
            'Magic Missile',
            'Magic Missile',
            'Magic Missile',
            'Magic Missile',
            'Magic Missile',
            'Magic Missile',
            'Magic Missile',
        );
        $opponent = CharacterMother::withItems('boss', 100, 'Greataxe');

        $sut = Combat::ofCharacters($player, $opponent);

        foreach (range(1, $turns * 2) as $turn) {
            $sut->next();
        }

        self::assertSame($startingHitPoints - $expectedDamage, $player->hitPoints());
    }

    public function test first scenario(): void
    {
    }
}
