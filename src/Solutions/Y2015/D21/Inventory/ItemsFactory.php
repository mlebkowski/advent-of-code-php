<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D21\Inventory;

final readonly class ItemsFactory
{
    public static function all(): iterable
    {
        yield ItemPrice::of(8, Item::of('Dagger', damage: 4, armor: 0, type: ItemType::Weapon));
        yield ItemPrice::of(10, Item::of('Shortsword', damage: 5, armor: 0, type: ItemType::Weapon));
        yield ItemPrice::of(25, Item::of('Warhammer', damage: 6, armor: 0, type: ItemType::Weapon));
        yield ItemPrice::of(40, Item::of('Longsword', damage: 7, armor: 0, type: ItemType::Weapon));
        yield ItemPrice::of(74, Item::of('Greataxe', damage: 8, armor: 0, type: ItemType::Weapon));
        yield ItemPrice::of(13, Item::of('Leather', damage: 0, armor: 1, type: ItemType::Armor));
        yield ItemPrice::of(31, Item::of('Chainmail', damage: 0, armor: 2, type: ItemType::Armor));
        yield ItemPrice::of(53, Item::of('Splintmail', damage: 0, armor: 3, type: ItemType::Armor));
        yield ItemPrice::of(75, Item::of('Bandedmail', damage: 0, armor: 4, type: ItemType::Armor));
        yield ItemPrice::of(102, Item::of('Platemail', damage: 0, armor: 5, type: ItemType::Armor));
        yield ItemPrice::of(25, Item::of('Damage +1', damage: 1, armor: 0, type: ItemType::Ring));
        yield ItemPrice::of(50, Item::of('Damage +2', damage: 2, armor: 0, type: ItemType::Ring));
        yield ItemPrice::of(100, Item::of('Damage +3', damage: 3, armor: 0, type: ItemType::Ring));
        yield ItemPrice::of(20, Item::of('Defense +1', damage: 0, armor: 1, type: ItemType::Ring));
        yield ItemPrice::of(40, Item::of('Defense +2', damage: 0, armor: 2, type: ItemType::Ring));
        yield ItemPrice::of(80, Item::of('Defense +3', damage: 0, armor: 3, type: ItemType::Ring));
    }
}
