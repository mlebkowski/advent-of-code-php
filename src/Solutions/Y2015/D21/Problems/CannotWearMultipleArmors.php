<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D21\Problems;

use Exception;

final class CannotWearMultipleArmors extends Exception implements InventoryProblem
{
    /**
     * @throws self
     */
    public static function whenMoreThanOneArmor(int $count): void
    {
        $count > 1 && throw new self("You can equip at most one armor, tried to use $count");
    }
}
