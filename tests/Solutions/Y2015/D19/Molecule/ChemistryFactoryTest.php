<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule;

use App\Solutions\Y2015\D19\ReplacementsMother;
use PHPUnit\Framework\TestCase;
use Stringable;

final class ChemistryFactoryTest extends TestCase
{
    public function test of replacements()
    {
        $sut = ChemistryFactory::ofReplacements(...ReplacementsMother::some());
        $elements = implode(', ', $sut->elements);

        self::assertSame('Al, B, C, Ca, F, H, Mg, N, O, P, Si, Th, Ti', $elements);

        $instructions = $sut->instructions;
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
            H => C(Al)
            H => C(F,F,F)
            H => C(F,Mg)
            H => C(Mg,F)
            H => HCa
            H => N(F,F)
            H => N(Mg)
            H => NTh
            H => O(F)
            H => OB
            Mg => BF
            Mg => TiMg
            N => C(F)
            N => HSi
            O => C(F,F)
            O => C(Mg)
            O => HP
            O => N(F)
            O => OTi
            P => CaP
            P => PTi
            P => Si(F)
            Si => CaSi
            Th => ThCa
            Ti => BP
            Ti => TiTi
            e => HF
            e => NAl
            e => OMg
            EOF,
            $instructions,
        );
    }
}
