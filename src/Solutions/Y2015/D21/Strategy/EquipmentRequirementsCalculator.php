<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D21\Strategy;

use App\Aoc\Progress\Progress;
use App\Lib\Generators\Combination;
use App\Lib\Generators\Product;
use App\Solutions\Y2015\D21\Character;
use App\Solutions\Y2015\D21\Inventory\ItemPrice;
use App\Solutions\Y2015\D21\Inventory\ItemsFactory;
use App\Solutions\Y2015\D21\Inventory\ItemType;
use loophp\collection\Collection;

final readonly class EquipmentRequirementsCalculator
{
    public static function against(Character $character): ShoppingCart
    {
        $positivePointsRequired = $character->attack + $character->armor;

        $ofType = static function (ItemType $type) {
            return static fn (ItemPrice $price) => $price->item->type->is($type);
        };

        $items = Collect(ItemsFactory::all());
        $weapons = $items->filter($ofType(ItemType::Weapon))->all();
        $armors = $items->filter($ofType(ItemType::Armor))->all();
        $rings = $items->filter($ofType(ItemType::Ring))->all();

        $inventories = Product::ofGenerators(
            Combination::takeWithoutRepeats(1)->from($weapons),
            Combination::rangeWithoutRepeats(0, 1)->from($armors),
            Combination::rangeWithoutRepeats(0, 2)->from($rings),
        );

        $progress = Progress::ofExpectedIterations(600)->withDelay(1_500);

        return Collection::fromGenerator($inventories)
            ->map(ShoppingCart::of(...))
            ->apply($progress->step(...))
            ->apply($progress->report(...))
            ->filter(static fn (ShoppingCart $cart) => $cart->satisfiesRequirements(
                pointsRequired: $positivePointsRequired,
            ))
            ->sort(callback: ShoppingCart::cheapest(...))
            ->first();
    }
}
