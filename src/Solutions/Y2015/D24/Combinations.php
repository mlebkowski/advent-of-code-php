<?php
declare(strict_types=1);

namespace App\Solutions\Y2015\D24;

use Generator;

final readonly class Combinations
{
    public static function selectSetsWithSum(int $sum): self
    {
        return new self($sum);
    }

    public function __construct(private int $sum)
    {
    }

    public function from(array $items): Generator
    {
        $count = count($items);
        if ($count === 0) {
            return;
        }

        [$value] = $items;
        if ($value === $this->sum) {
            yield [$value];
            return;
        }

        if ($value > $this->sum) {
            return;
        }

        $remaining = $this->sum - $value;
        $items = array_slice($items, 1);
        foreach (self::selectSetsWithSum($remaining)->from($items) as $combination) {
            yield [$value, ...$combination];
        }

        yield from $this->from($items);
    }
}
