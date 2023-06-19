<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D21\Inventory;

enum ItemType: string
{
    case Weapon = 'weapon';
    case Armor = 'armor';
    case Ring = 'ring';

    public function is(self $other): bool
    {
        return $this === $other;
    }
}
