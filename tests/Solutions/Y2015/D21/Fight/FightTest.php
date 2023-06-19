<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D21\Fight;

use App\Solutions\Y2015\D21\CharacterMother;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

final class FightTest extends TestCase
{
    public function test sample scenario(): void
    {
        $player = CharacterMother::withItems('player', 8, 'Platemail', 'Shortsword');
        $boss = CharacterMother::withItems('boss', 12, 'Longsword', 'Chainmail');

        $sut = Fight::ofCharacters($player, $boss);
        $actual = implode("\n", iterator_to_array($sut));

        self::assertSame(
            trim(
                <<<EOF
                The player deals 5-2 = 3 damage; the boss goes down to 9 hit points.
                The boss deals 7-5 = 2 damage; the player goes down to 6 hit points.
                The player deals 5-2 = 3 damage; the boss goes down to 6 hit points.
                The boss deals 7-5 = 2 damage; the player goes down to 4 hit points.
                The player deals 5-2 = 3 damage; the boss goes down to 3 hit points.
                The boss deals 7-5 = 2 damage; the player goes down to 2 hit points.
                The player deals 5-2 = 3 damage; the boss goes down to 0 hit points.            
                EOF,
            ),
            $actual,
        );
    }

    #[DataProviderExternal(FightEquipmentDataProvider::class, 'data')]
    public function test different equipments(array $mine, array $theirs): void
    {
        $me = CharacterMother::withItems('me', 100, ...$mine);
        $them = CharacterMother::withItems('them', 100, ...$theirs);

        $fight = Fight::ofCharacters($me, $them);
        $fight->next();
        self::assertEquals($them->hitPoints(), $me->hitPoints());
    }

    public function test ultimate(): void
    {
        $player = CharacterMother::withItems('player', 100, 'Longsword', 'Chainmail', 'Defense +1');
        $boss = CharacterMother::withItems('boss', 100, 'Greataxe', 'Chainmail');
        $sut = Fight::ofCharacters($player, $boss);
        iterator_to_array($sut);

        self::assertEquals($player, $sut->getReturn());
        self::assertTrue($player->isAlive());
    }
}
