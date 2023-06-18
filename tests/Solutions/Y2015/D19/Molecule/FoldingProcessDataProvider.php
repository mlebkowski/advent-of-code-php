<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule;

use App\Solutions\Y2015\D19\Molecule\Parser\Pair;

final class FoldingProcessDataProvider
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

    public static function edge cases(): iterable
    {
        yield ['SiTh(F)', 'F'];
        yield ['ThSiThPBCaCaSi', 'F'];
        yield ['PTiTiTiBSi(SiAl)', 'F'];
        yield ['CaSiThSiThPBCaCaSi', 'Si'];
    }
}
