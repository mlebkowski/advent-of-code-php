<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Combat\Magical;

use App\Realms\RolePlaying\CharacterMother;
use App\Realms\RolePlaying\Combat\Attack;
use App\Realms\RolePlaying\Combat\Combat;
use App\Realms\RolePlaying\Combat\MagicalAttack;
use App\Realms\RolePlaying\Combat\Turn;
use loophp\collection\Collection;
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
        $player = CharacterMother::withSpells('Player', 10, 250, 'Poison', 'Magic Missile');
        $boss = CharacterMother::withItems('Boss', 13, 'Greataxe');

        $result = [];

        $sut = Combat::ofCharacters($player, $boss);
        [$attacker, $defender] = [$player, $boss];
        $turnHeader = TurnHeader::of($attacker, $player, $boss);
        foreach ($sut as $turn) {
            $result[] = $turnHeader;
            $result[] = $turn;
            $result[] = "";

            [$attacker, $defender] = [$defender, $attacker];
            $turnHeader = TurnHeader::of($attacker, $player, $boss);
        }

        $actual = trim(implode("\n", $result));

        self::assertSame(
            <<<EOF
            -- Player turn --
            - Player has 10 hit points, 0 armor, 250 mana
            - Boss has 13 hit points
            Player casts Poison.
            
            -- Boss turn --
            - Player has 10 hit points, 0 armor, 77 mana
            - Boss has 13 hit points
            Poison deals 3 damage; its timer is now 5.
            Boss attacks for 8 damage.
            
            -- Player turn --
            - Player has 2 hit points, 0 armor, 77 mana
            - Boss has 10 hit points
            Poison deals 3 damage; its timer is now 4.
            Player casts Magic Missile: deals 4 damage.
            
            -- Boss turn --
            - Player has 2 hit points, 0 armor, 24 mana
            - Boss has 3 hit points
            Poison deals 3 damage; its timer is now 3.
            This kills the Boss, and the Player wins.
            EOF,
            $actual,
        );
    }

    public function test second scenario(): void
    {
        $player = CharacterMother::withSpells(
            'Player',
            10,
            250,
            'Recharge',
            'Shield',
            'Drain',
            'Poison',
            'Magic Missile',
        );
        $boss = CharacterMother::withItems('Boss', 14, 'Greataxe');

        $result = [];

        $sut = Combat::ofCharacters($player, $boss);
        [$attacker, $defender] = [$player, $boss];
        $turnHeader = TurnHeader::of($attacker, $player, $boss);
        foreach ($sut as $turn) {
            $result[] = $turnHeader;
            $result[] = $turn;
            $result[] = "";

            [$attacker, $defender] = [$defender, $attacker];
            $turnHeader = TurnHeader::of($attacker, $player, $boss);
        }

        $actual = trim(implode("\n", $result));

        self::assertSame(
            <<<EOF
            -- Player turn --
            - Player has 10 hit points, 0 armor, 250 mana
            - Boss has 14 hit points
            Player casts Recharge.
            
            -- Boss turn --
            - Player has 10 hit points, 0 armor, 21 mana
            - Boss has 14 hit points
            Recharge provides 101 mana; its timer is now 4.
            Boss attacks for 8 damage.
            
            -- Player turn --
            - Player has 2 hit points, 0 armor, 122 mana
            - Boss has 14 hit points
            Recharge provides 101 mana; its timer is now 3.
            Player casts Shield.
            
            -- Boss turn --
            - Player has 2 hit points, 0 armor, 110 mana
            - Boss has 14 hit points
            Recharge provides 101 mana; its timer is now 2.
            Shield increases armor by 7; its timer is now 5.
            The Boss deals 8-7 = 1 damage; the Player goes down to 1 hit points.
            
            -- Player turn --
            - Player has 1 hit points, 7 armor, 211 mana
            - Boss has 14 hit points
            Recharge provides 101 mana; its timer is now 1.
            Player casts Drain: deals 2 damage, and heals 2 hit points.
            
            -- Boss turn --
            - Player has 3 hit points, 7 armor, 239 mana
            - Boss has 12 hit points
            Recharge provides 101 mana; its timer is now 0.
            The Boss deals 8-7 = 1 damage; the Player goes down to 2 hit points.

            -- Player turn --
            - Player has 2 hit points, 7 armor, 340 mana
            - Boss has 12 hit points
            Player casts Poison.
            
            -- Boss turn --
            - Player has 2 hit points, 7 armor, 167 mana
            - Boss has 12 hit points
            Poison deals 3 damage; its timer is now 5.
            The Boss deals 8-7 = 1 damage; the Player goes down to 1 hit points.
            
            -- Player turn --
            - Player has 1 hit points, 7 armor, 167 mana
            - Boss has 9 hit points
            Poison deals 3 damage; its timer is now 4.
            Player casts Magic Missile: deals 4 damage.
            
            -- Boss turn --
            - Player has 1 hit points, 7 armor, 114 mana
            - Boss has 2 hit points
            Shield wears off, decreases armor by 7.
            Poison deals 3 damage; its timer is now 3.
            This kills the Boss, and the Player wins.
            EOF,
            $actual,
        );
    }

    public function test winning condition(): void
    {
        $boss = CharacterMother::withItems('Boss', 55, 'Greataxe');
        $player = CharacterMother::withSpells(
            'Player',
            50,
            500,
            'Magic Missile',
            'Recharge',
            'Poison',
            'Magic Missile',
            'Shield',
            'Poison',
            'Magic Missile',
            'Magic Missile',
            'Magic Missile',
        );

        $sut = Combat::ofCharacters($player, $boss);
        $manaSpent = Collection::fromGenerator($sut)
            ->map(static fn (Turn $turn) => $turn->attack)
            ->filter(static fn (?Attack $attack) => $attack instanceof MagicalAttack)
            ->map(static fn (MagicalAttack $attack) => $attack->spell?->cost ?? 0)
            ->reduce(static fn (int $sum, int $cost) => $sum + $cost, 0);

        self::assertTrue($player->isAlive());
        self::assertTrue($boss->isDead());
        self::assertSame(953, $manaSpent);
    }
}
