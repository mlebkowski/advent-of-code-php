<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D21;

use PHPUnit\Framework\TestCase;

final class CharacterTest extends TestCase
{
    public function test attack takes at least one point of damage(): void
    {
        $sut = CharacterMother::withItems('Player', 3, 'Greataxe', 'Leather' /* +1 armor */);

        $sut->receiveAttack(1);
        self::assertSame(2, $sut->hitPoints());
        self::assertFalse($sut->isDead());
        $sut->receiveAttack(1);
        self::assertSame(1, $sut->hitPoints());
        self::assertFalse($sut->isDead());
        $sut->receiveAttack(1);
        self::assertSame(0, $sut->hitPoints());
        self::assertTrue($sut->isDead());
    }

    public function test attack takes damage reduced by armor(): void
    {
        $sut = CharacterMother::withItems('Player', 5, 'Greataxe', 'Chainmail' /* +2 armor */);

        $sut->receiveAttack(4);
        self::assertSame(3, $sut->hitPoints());
        self::assertFalse($sut->isDead());
        $sut->receiveAttack(4);
        self::assertSame(1, $sut->hitPoints());
        self::assertFalse($sut->isDead());
        $sut->receiveAttack(4);
        self::assertSame(-1, $sut->hitPoints());
        self::assertTrue($sut->isDead());
    }
}
