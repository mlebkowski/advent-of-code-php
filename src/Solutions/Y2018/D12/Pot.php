<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D12;

enum Pot: string
{
    case Empty = '.';
    case Plant = '#';

    public static function fromMany(string $pots): array
    {
        return array_map(self::from(...), str_split($pots));
    }

    public function isEmpty(): bool
    {
        return $this === self::Empty;
    }
}
