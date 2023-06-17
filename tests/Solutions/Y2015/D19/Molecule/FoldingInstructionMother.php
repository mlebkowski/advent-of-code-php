<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule;

final class FoldingInstructionMother
{
    public static function some(): array
    {
        return ChemistryMother::some()->instructions;
    }
}
