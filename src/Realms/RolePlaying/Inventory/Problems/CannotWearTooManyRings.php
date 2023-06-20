<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Inventory\Problems;

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
