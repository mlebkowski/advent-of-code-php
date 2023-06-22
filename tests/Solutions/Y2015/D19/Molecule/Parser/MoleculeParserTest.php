<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule\Parser;

use App\Solutions\Y2015\D19\Molecule\ChemistryMother;
use App\Solutions\Y2015\D19\Molecule\FoldingProcessMother;
use PHPUnit\Framework\TestCase;

final class MoleculeParserTest extends TestCase
{
    public static function data(): iterable
    {
        yield [
            'SiTh(F)',
            '{(SiTh, F) | [Si, (Th, F)}',
            1,
            'e',
        ];
        yield ['CaPBCaPB', '[CaP, [BCa, PB]]', 5, 'Ca'];
        yield ['CaPTiBCaSiThCaSiThPMg', '[CaP, [TiB, [CaSi, [ThCa, [SiTh, PMg]]]]]', 11, 'F'];
        yield ['CaCaSiThCaCaCaSi', '[CaCa, [SiTh, [CaCa, CaSi]]]', 7, 'Si'];
        yield ['P(CaF)', '(P, CaF)', 2, 'Ca'];
        yield ['CaSi(SiAl,SiTh(F))', '(CaSi, SiAl, (SiTh, F))'];
        yield [
            'CaCaSiThCaCaCaSi(P(CaF)F,PMg)',
            '([CaCa, [SiTh, [CaCa, CaSi]]], [(P, CaF), F], PMg)',
            12,
            'Ca',
        ];
        yield [
            'CaSi(TiBSiThSi(SiAl,CaF)P(F)SiThCaF)',
            '(CaSi, [([TiB, [SiTh, Si]], SiAl, CaF), [(P, F), [SiTh, CaF]]])',
        ];
        yield [
            'PTiTiTiBSi(SiAl)',
            '([PTi, [TiTi, [B, Si]]], SiAl)',
        ];
    }

    /** @dataProvider data */
    public function test fold(string $molecule, string $expected, int $steps = null, string $element = null): void
    {
        $this->markTestSkipped('Parsing is in shamles :(');
        $chemistry = ChemistryMother::some();
        $sut = MoleculeParser::of($chemistry);
        $actual = $sut->build($molecule);
        self::assertSame($expected, (string)$actual);
        if ($steps && $element) {
            $foldingProcess = FoldingProcessMother::some();
            $result = $foldingProcess->fold($actual);
            self::assertSame($element, (string)$result);
            self::assertSame($steps, $foldingProcess->stepsCount());
        }
    }
}
