<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule;

use App\Solutions\Y2015\D19\Molecule\Parser\Pair;
use PHPUnit\Framework\TestCase;

final class FoldingProcessTest extends TestCase
{
    public static function data(): iterable
    {
        yield [1, Compound::of(Element::of('H'), Element::of('F'))];
        yield [1, Compound::of(Element::of('N'), Element::of('Al'))];
        yield [1, Compound::of(Element::of('O'), Element::of('Mg'))];
        yield [
            4,
            Pair::of(
                Particle::of(
                    Element::of('C'),
                    Element::of('F'),
                ),
                Pair::of(
                    Compound::of(
                        Element::of('Th'),
                        Element::of('Ca'),
                    ),
                    Element::of('F'),
                ),
            ),
        ];
    }

    /** @dataProvider data */
    public function test fold(int $steps, Compound|Particle|Pair $given): void
    {
        $sut = FoldingProcess::ofInstructions(...FoldingInstructionMother::some());

        $actual = $sut->fold($given);

        self::assertTrue($actual instanceof Protomolecule);
        self::assertSame($steps, $sut->stepsCount());
    }
}
