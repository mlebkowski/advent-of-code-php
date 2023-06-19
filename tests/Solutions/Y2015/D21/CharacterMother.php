<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D21;

use loophp\collection\Collection;

final class CharacterMother
{
    public static function withItems(int $hitPoints, string ...$names): Character
    {
        return Character::of(
            $hitPoints,
            ...
            Collection::fromIterable($names)
                ->map(ItemsFactory::get(...))
                ->all(),
        );
    }
}
