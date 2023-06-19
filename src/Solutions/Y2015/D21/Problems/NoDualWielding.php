<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D21\Problems;

use Exception;

final class NoDualWielding extends Exception implements InventoryProblem
{
    /**
     * @throws self
     */
    public static function whenMoreThanOneWeapon(int $count): void
    {
        $count > 1 && throw new self("You can only equip 1 weapon, tried to use $count");
    }
}
