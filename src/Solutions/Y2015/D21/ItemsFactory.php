<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D21;

use RuntimeException;

final class ItemsFactory
{
    private const Inventory = [
        'Dagger' => ['cost' => 8, 'damage' => 4, 'armor' => 0],
        'Shortsword' => ['cost' => 10, 'damage' => 5, 'armor' => 0],
        'Warhammer' => ['cost' => 25, 'damage' => 6, 'armor' => 0],
        'Longsword' => ['cost' => 40, 'damage' => 7, 'armor' => 0],
        'Greataxe' => ['cost' => 74, 'damage' => 8, 'armor' => 0],
        'Leather' => ['cost' => 13, 'damage' => 0, 'armor' => 1],
        'Chainmail' => ['cost' => 31, 'damage' => 0, 'armor' => 2],
        'Splintmail' => ['cost' => 53, 'damage' => 0, 'armor' => 3],
        'Bandedmail' => ['cost' => 75, 'damage' => 0, 'armor' => 4],
        'Platemail' => ['cost' => 102, 'damage' => 0, 'armor' => 5],
        'Damage +1' => ['cost' => 25, 'damage' => 1, 'armor' => 0],
        'Damage +2' => ['cost' => 50, 'damage' => 2, 'armor' => 0],
        'Damage +3' => ['cost' => 100, 'damage' => 3, 'armor' => 0],
        'Defense +1' => ['cost' => 20, 'damage' => 0, 'armor' => 1],
        'Defense +2' => ['cost' => 40, 'damage' => 0, 'armor' => 2],
        'Defense +3' => ['cost' => 80, 'damage' => 0, 'armor' => 3],
    ];

    public static function get(string $name): Item
    {
        $data = self::Inventory[$name] ?? throw new RuntimeException("No such item $name");
        return Item::of($name, $data['damage'], $data['armor']);
    }
}
