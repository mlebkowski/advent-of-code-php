<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule;

use PHPUnit\Framework\TestCase;
use Stringable;

final class ChemistryTest extends TestCase
{
    public function test make derivative(): void
    {
        $sut = ChemistryMother::some();
        $actual = $sut->makeDerivative();

        $elements = implode(', ', $actual->elements);

        self::assertSame('Al, B, Ca, F, Mg, P, Si, Th, Ti', $elements);

        $instructions = $actual->instructions;
        usort(
            $instructions,
            static fn (Stringable $alpha, Stringable $bravo) => (string)$alpha <=> (string)$bravo,
        );
        $instructions = implode("\n", $instructions);

        self::assertSame(
            <<<EOF
            Al => Th(F)
            Al => ThF
            B => BCa
            B => Ti(F)
            B => TiB
            Ca => CaCa
            Ca => P(F)
            Ca => PB
            Ca => Si(F,F)
            Ca => Si(Mg)
            Ca => SiTh
            F => CaF
            F => PMg
            F => SiAl
            Mg => BF
            Mg => TiMg
            P => CaP
            P => PTi
            P => Si(F)
            Si => CaSi
            Th => ThCa
            Ti => BP
            Ti => TiTi
            EOF,
            $instructions,
        );
    }

    public function test make second derivative(): void
    {
        $sut = ChemistryMother::some();
        $actual = $sut->makeDerivative()->makeDerivative();

        $elements = implode(', ', $actual->elements);

        self::assertSame('Al, B, Ca, F, Mg, P, Si, Th, Ti', $elements);

        $instructions = $actual->instructions;
        usort(
            $instructions,
            static fn (Stringable $alpha, Stringable $bravo) => (string)$alpha <=> (string)$bravo,
        );
        $instructions = implode("\n", $instructions);

        self::assertSame(
            <<<EOF
            Al => Th(F)
            Al => ThF
            B => BCa
            B => Ti(F)
            B => TiB
            Ca => CaCa
            Ca => P(F)
            Ca => PB
            Ca => Si(F,F)
            Ca => Si(Mg)
            Ca => SiTh
            F => CaF
            F => PMg
            F => SiAl
            Mg => BF
            Mg => TiMg
            P => CaP
            P => PTi
            P => Si(F)
            Si => CaSi
            Th => ThCa
            Ti => BP
            Ti => TiTi
            EOF,
            $instructions,
        );
    }
}
