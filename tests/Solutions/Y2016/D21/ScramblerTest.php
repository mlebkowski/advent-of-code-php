<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D21;

use App\Solutions\Y2016\D21\Operations\MovePosition;
use App\Solutions\Y2016\D21\Operations\ReverseRange;
use App\Solutions\Y2016\D21\Operations\RotateBasedOnLetter;
use App\Solutions\Y2016\D21\Operations\RotateLeft;
use App\Solutions\Y2016\D21\Operations\SwapLetters;
use App\Solutions\Y2016\D21\Operations\SwapPositions;
use PHPUnit\Framework\TestCase;

final class ScramblerTest extends TestCase
{
    public function test(): void
    {
        $sut = Scrambler::of(
            SwapPositions::of(4, 0),
            SwapLetters::of('d', 'b'),
            ReverseRange::of(0, 4),
            RotateLeft::of(1),
            MovePosition::of(1, 4),
            MovePosition::of(3, 0),
            RotateBasedOnLetter::of('b'),
            RotateBasedOnLetter::of('d'),
        );

        self::assertSame('decab', $sut->scramble('abcde'));
        self::assertSame('abcde', $sut->reverse('decab'));
    }
}
