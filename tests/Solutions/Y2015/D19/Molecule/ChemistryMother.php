<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule;

use App\Solutions\Y2015\D19\ReplacementsMother;

final class ChemistryMother
{
    public static function some(): Chemistry
    {
        return ChemistryFactory::ofReplacements(...ReplacementsMother::some());
    }
}
