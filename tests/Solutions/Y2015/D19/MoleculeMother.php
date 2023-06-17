<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19;

final class MoleculeMother
{
    public static function some(): string
    {
        return NuclearMedicineInputMother::some()->molecule;
    }
}
