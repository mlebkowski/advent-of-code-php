<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule\Parser;

use PHPUnit\Framework\TestCase;

final class ParenthesisMatcherTest extends TestCase
{
    public static function data(): iterable
    {
        yield ['P(F)', [4, 'P', 'F']];
        yield ['P(F)P(F)', [4, 'P', 'F']];
        // yield ['PRnFAr', [6, 'P', 'F']];
        // yield ['PRnFArPRnFAr', [6, 'P', 'F']];
        yield ['P(CaSi(OMg))', [12, 'P', 'CaSi(OMg)']];
        // yield ['PRnCaSiRnOMgArAr', [16, 'P', 'CaSi(OMg)']];
        yield ['CaCaCaCaSiTh(F)', [15, 'CaCaCaCaSiTh', 'F']];
        // yield ['CaCaCaCaSiThRnFAr', [17, 'CaCaCaCaSiTh', 'F']];
        yield ['C(F,P(F),F)', [11, 'C', 'F', 'P(F)', 'F']];
        // yield ['CRnFYPRnFArYFAr', [15, 'C', 'F', 'P(F)', 'F']];
    }

    /** @dataProvider data */
    public function test read branch(string $input, array|null $expected): void
    {
        $actual = ParenthesisMatcher::march($input);
        self::assertSame($expected, [$actual->length, $actual->leftPart, ...$actual->arguments]);
    }

    /** @dataProvider data */
    public function test read branch negative scenarios(): void
    {
        self::assertNull(ParenthesisMatcher::march(''));
        self::assertNull(ParenthesisMatcher::march('CaCaCaCaSiTh'));
    }
}
