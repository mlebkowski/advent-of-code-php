<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D21\Problems;

use Exception;

final class CannotWearTooManyRings extends Exception implements InventoryProblem
{
    /**
     * @throws self
     */
    public static function whenMoreThanTwoRings(int $count): void
    {
        $count > 2 && throw new self("You can equip at most two rings, tried to use $count");
    }
}
