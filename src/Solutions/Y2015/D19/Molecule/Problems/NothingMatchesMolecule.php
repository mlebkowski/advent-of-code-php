<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule\Problems;

use Exception;

final class NothingMatchesMolecule extends Exception
{
    /**
     * @throws NothingMatchesMolecule
     */
    public static function whenever(bool $activationCondition, string $molecule): void
    {
        $activationCondition && throw new self("Nothing matches $molecule");
    }
}
