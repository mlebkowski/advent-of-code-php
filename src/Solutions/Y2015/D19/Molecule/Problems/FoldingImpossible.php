<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule\Problems;

use App\Solutions\Y2015\D19\Molecule\Parser\Token;
use Exception;

final class FoldingImpossible extends Exception
{
    public static function ofToken(Token $token, int $step): self
    {
        return new self("Cannot fold $token at step $step");
    }
}
