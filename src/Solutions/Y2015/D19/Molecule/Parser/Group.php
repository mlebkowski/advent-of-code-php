<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule\Parser;

use App\Solutions\Y2015\D19\Molecule\Foldable;
use App\Solutions\Y2015\D19\Molecule\FoldingProcess;
use App\Solutions\Y2015\D19\Molecule\Problems\FoldingImpossible;
use App\Solutions\Y2015\D19\Molecule\Problems\ProtomoleculeSpreadToEros;

interface Group extends Token
{
    /**
     * @throws ProtomoleculeSpreadToEros
     * @throws FoldingImpossible
     */
    public function intoFoldable(FoldingProcess $foldingProcess): Foldable;
}
