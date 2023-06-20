<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D21\Strategy;

use App\Lib\Generators\Combination;
use App\Lib\Generators\Product;
use App\Realms\RolePlaying\Inventory\ItemPrice;
use App\Realms\RolePlaying\Inventory\ItemsFactory;
use App\Realms\RolePlaying\Inventory\ItemType;
use Generator;

final readonly class InventoriesSatisfyingRequirements
{
    public static function all(): Generator
    {
        $ofType = static function (ItemType $type) {
            return static fn (ItemPrice $price) => $price->item->type->is($type);
        };

        $items = Collect(ItemsFactory::all());
        $weapons = $items->filter($ofType(ItemType::Weapon))->all();
        $armors = $items->filter($ofType(ItemType::Armor))->all();
        $rings = $items->filter($ofType(ItemType::Ring))->all();

        return Product::ofGenerators(
            Combination::takeWithoutRepeats(1)->from($weapons),
            Combination::rangeWithoutRepeats(0, 1)->from($armors),
            Combination::rangeWithoutRepeats(0, 2)->from($rings),
        );
    }
}
