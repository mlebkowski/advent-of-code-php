<?php
declare(strict_types=1);

namespace App\Aoc\Parser;

use PHPUnit\Framework\TestCase;

final class ReMatcherTest extends TestCase
{
    public function test(): void
    {
        $given = <<<EOF
        Before: [0, 1, 1, 0]
        1 0 2 2
        After:  [0, 1, 0, 0]
        
        Before: [1, 2, 2, 3]
        4 1 3 1
        After:  [1, 0, 2, 3]
        
        Before: [0, 1, 2, 3]
        3 1 2 0
        After:  [0, 1, 2, 3]
        EOF;
        $pattern = <<<EOF
        %w: [%d, %d, %d, %d]
        %s
        %s  [%d, %d, %d, %d]
        EOF;

        $sut = ReMatcher::of($pattern, CatchAllValueObject::of(...));
        $actual = $sut->match($given);
        self::assertSame(
            [
                ['Before', 0, 1, 1, 0, '1 0 2 2', 'After:', 0, 1, 0, 0],
                ['Before', 1, 2, 2, 3, '4 1 3 1', 'After:', 1, 0, 2, 3],
                ['Before', 0, 1, 2, 3, '3 1 2 0', 'After:', 0, 1, 2, 3],
            ],
            CatchAllValueObject::extractArguments(...$actual),
        );
    }
}
