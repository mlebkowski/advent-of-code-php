<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Fight;

final class FightEquipmentDataProvider
{
    public static function data(): iterable
    {
        yield [
            ['Shortsword', 'Platemail'],
            ['Greataxe', 'Chainmail'],
        ];
        yield [
            ['Greataxe', 'Chainmail'],
            ['Greataxe', 'Chainmail'],
        ];
        yield [
            ['Warhammer', 'Bandedmail'],
            ['Greataxe', 'Chainmail'],
        ];
        yield [
            ['Longsword', 'Splintmail'],
            ['Greataxe', 'Chainmail'],
        ];
    }
}
