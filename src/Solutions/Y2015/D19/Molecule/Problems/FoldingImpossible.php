<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule\Problems;

use App\Solutions\Y2015\D19\Molecule\FoldingInstruction;
use App\Solutions\Y2015\D19\Molecule\Parser\Token;
use Exception;

final class FoldingImpossible extends Exception
{
    /**
     * @throws FoldingImpossible
     * @psalm-assert =FoldingInstruction $instruction
     */
    public static function whenNoInstructions(
        ?FoldingInstruction $instruction,
        Token $token,
        int $step,
        string $input,
    ): void {
        $instruction ?? throw new self("Cannot fold $token at step $step or $input");
    }
}
