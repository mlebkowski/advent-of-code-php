<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19;

use PHPUnit\Framework\TestCase;

final class MoleculeReplacementFactoryTest extends TestCase
{
    public static function data(): iterable
    {
        yield [Replacement::of('H', 'HO'), 'HOOH', 'HOHO'];
        yield [Replacement::of('H', 'OH'), 'OHOH', 'HOOH'];
        yield [Replacement::of('O', 'HH'), 'HHHH'];
    }

    /** @dataProvider data */
    public function test generate replacements(Replacement $replacement, string ...$expected): void
    {
        $sut = MoleculeReplacementFactory::of('HOH');

        $actual = iterator_to_array(
            $sut->generateReplacements($replacement),
        );

        self::assertSame($expected, $actual);
    }

    public function test it folds(): void
    {
        $sut = MoleculeReplacementFactory::of('H1H2H3');
        $actual = iterator_to_array($sut->fold(Replacement::of('x', 'H')));
        self::assertSame(['x1H2H3', 'H1x2H3', 'H1H2x3'], $actual);
    }

    public function test it does not yield anything if there are no matches(): void
    {
        $sut = MoleculeReplacementFactory::of('1234');
        $actual = iterator_to_array($sut->fold(Replacement::of('x', 'H')));
        self::assertSame([], $actual);
    }
}
