<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19;

final class ReplacementsMother
{
    public static function some(): array
    {
        return NuclearMedicineInputMother::some()->replacements;
    }
}
