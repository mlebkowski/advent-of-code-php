<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying;

use App\Realms\RolePlaying\Inventory\ItemPrice;
use App\Realms\RolePlaying\Inventory\ItemsFactory;
use App\Realms\RolePlaying\Inventory\NoItemByThatName;
use loophp\collection\Collection;

final class CharacterMother
{
    public static function withItems(string $name, int $hitPoints, string ...$names): Character
    {
        $items = Collection::fromIterable(ItemsFactory::all())
            ->map(static fn (ItemPrice $itemPrice) => [$itemPrice->item->name, $itemPrice->item])
            ->unpack()
            ->all(false);

        return Character::of(
            $name,
            $hitPoints,
            ...
            Collection::fromIterable($names)
                ->map(static fn (string $name) => $items[$name] ?? NoItemByThatName::ofName($name))
                ->all(),
        );
    }
}
