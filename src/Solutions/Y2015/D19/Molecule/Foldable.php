<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule;

interface Foldable extends Parser\Token
{
    public function equals(Foldable $other): bool;
}
