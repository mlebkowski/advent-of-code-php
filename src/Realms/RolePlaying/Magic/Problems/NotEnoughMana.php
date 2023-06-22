<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Magic\Problems;

use Exception;

final class NotEnoughMana extends Exception
{
    /**
     * @throws NotEnoughMana
     */
    public static function whenCostGreaterThanMana(int $cost, int $mana): void
    {
        ($cost > $mana) && throw new self("Not enough mana to cast $cost");
    }
}
