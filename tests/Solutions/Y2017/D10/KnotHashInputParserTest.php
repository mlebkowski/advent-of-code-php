<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D10;

use PHPUnit\Framework\TestCase;

final class KnotHashInputParserTest extends TestCase
{
    public function test(): void
    {
        $given = "1,2,3\n";
        $sut = new KnotHashInputParser();
        $actual = $sut->parse($given);
        self::assertSame([1, 2, 3], $actual->asIntegers);
        self::assertSame([49, 44, 50, 44, 51], $actual->asCharCodes);
    }
}
