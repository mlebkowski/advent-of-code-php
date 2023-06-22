<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Combat\Physical;

use App\Realms\RolePlaying\CharacterMother;
use App\Realms\RolePlaying\Combat\PhysicalAttack;
use PHPUnit\Framework\TestCase;

final class PhysicalAttackTest extends TestCase
{
    public function test attack takes at least one point of damage(): void
    {
        $attacker = CharacterMother::withItems('Attacker', 1, 'Dagger' /* +4 atk */);
        $defender = CharacterMother::withItems('Defender', 3, 'Greataxe', 'Bandedmail' /* +4 def */);

        PhysicalAttack::of($attacker, $defender);
        self::assertSame(2, $defender->hitPoints());
        self::assertFalse($defender->isDead());

        PhysicalAttack::of($attacker, $defender);
        self::assertSame(1, $defender->hitPoints());
        self::assertFalse($defender->isDead());

        PhysicalAttack::of($attacker, $defender);
        self::assertSame(0, $defender->hitPoints());
        self::assertTrue($defender->isDead());
    }

    public function test attack takes damage reduced by armor(): void
    {
        $attacker = CharacterMother::withItems('Attacker', 1, 'Dagger' /* +4 atk */);
        $defender = CharacterMother::withItems('Defender', 5, 'Greataxe', 'Chainmail' /* +2 def */);

        PhysicalAttack::of($attacker, $defender);
        self::assertSame(3, $defender->hitPoints());
        self::assertFalse($defender->isDead());

        PhysicalAttack::of($attacker, $defender);
        self::assertSame(1, $defender->hitPoints());
        self::assertFalse($defender->isDead());

        PhysicalAttack::of($attacker, $defender);
        self::assertSame(-1, $defender->hitPoints());
        self::assertTrue($defender->isDead());
    }

}
