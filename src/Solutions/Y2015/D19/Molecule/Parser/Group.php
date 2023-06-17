<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule\Parser;

use App\Solutions\Y2015\D19\Molecule\Foldable;
use App\Solutions\Y2015\D19\Molecule\FoldingProcess;

interface Group extends Token
{
    public function intoFoldable(FoldingProcess $foldingProcess): Foldable;
}
