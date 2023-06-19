<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D21\Inventory;

final class ItemShopMother
{
    public static function some(): ItemShop
    {
        return ItemShop::of(...ItemsFactory::all());
    }
}
