<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule\Problems;

use Exception;

final class ProtomoleculeSpreadToEros extends Exception
{
    public static function whenever(bool $activationCondition): void
    {
        $activationCondition && throw new self('Protomolecule was discovered too quickly');
    }

}
