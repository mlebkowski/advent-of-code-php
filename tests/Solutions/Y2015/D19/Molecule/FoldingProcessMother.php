<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule;

final class FoldingProcessMother
{
    public static function some(): FoldingProcess
    {
        return FoldingProcess::ofInstructions(...FoldingInstructionMother::some());
    }
}
