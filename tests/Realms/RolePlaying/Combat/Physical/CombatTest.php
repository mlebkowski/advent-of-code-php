<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Combat\Physical;

use App\Realms\RolePlaying\CharacterMother;
use App\Realms\RolePlaying\Combat\Combat;
use loophp\collection\Collection;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

#[CoversClass(Combat::class)]
final class CombatTest extends TestCase
{
    public function test sample scenario(): void
    {
        $player = CharacterMother::withItems('player', 8, 'Shortsword', 'Platemail');
        $boss = CharacterMother::withItems('boss', 12, 'Longsword', 'Chainmail');

        $sut = Combat::ofCharacters($player, $boss);
        $actual = Collection::fromGenerator($sut)->implode("\n");

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
                This kills the boss, and the player wins.
                EOF,
            ),
            $actual,
        );
    }

    #[DataProviderExternal(CombatEquipmentDataProvider::class, 'data')]
    public function test different equipments(array $mine, array $theirs): void
    {
        $me = CharacterMother::withItems('me', 100, ...$mine);
        $them = CharacterMother::withItems('them', 100, ...$theirs);

        $fight = Combat::ofCharacters($me, $them);
        $fight->next();
        self::assertEquals($them->hitPoints(), $me->hitPoints());
    }

    public function test ultimate part one(): void
    {
        $player = CharacterMother::withItems('player', 100, 'Longsword', 'Chainmail', 'Defense +1');
        $boss = CharacterMother::withItems('boss', 100, 'Greataxe', 'Chainmail');
        $sut = Combat::ofCharacters($player, $boss);
        iterator_to_array($sut);

        self::assertEquals($player, $sut->getReturn());
        self::assertTrue($player->isAlive());
    }

    public function test ultimate part two(): void
    {
        $player = CharacterMother::withItems('player', 100, 'Dagger', 'Damage +2', 'Damage +3');
        $boss = CharacterMother::withItems('boss', 100, 'Greataxe', 'Chainmail');
        $sut = Combat::ofCharacters($player, $boss);
        iterator_to_array($sut);

        self::assertEquals($boss, $sut->getReturn());
        self::assertTrue($player->isDead());
        self::assertTrue($boss->isAlive());
    }
}
