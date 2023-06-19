<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D21\Problems;

use Exception;

final class WeaponNotEquipped extends Exception implements InventoryProblem
{
    /**
     * @throws self
     */
    public static function whenNoWeapon(int $count): void
    {
        $count < 1 && throw new self("You need to equip at least one weapon!");
    }
}
