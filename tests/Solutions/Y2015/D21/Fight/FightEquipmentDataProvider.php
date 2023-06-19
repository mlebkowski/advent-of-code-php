<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D21\Fight;

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
