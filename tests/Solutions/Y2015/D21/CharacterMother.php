<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D21;

use App\Solutions\Y2015\D21\Inventory\ItemShopMother;
use loophp\collection\Collection;

final class CharacterMother
{
    public static function withItems(string $name, int $hitPoints, string ...$names): Character
    {
        $factory = ItemShopMother::some();
        return Character::of(
            $name,
            $hitPoints,
            ...
            Collection::fromIterable($names)
                ->map($factory->get(...))
                ->all(),
        );
    }
}
