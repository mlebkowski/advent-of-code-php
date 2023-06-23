<?php
declare(strict_types=1);

namespace App\Solutions\Y2015\D24;

use Generator;

final readonly class Combinations
{
    public static function selectSmallestSetsWithSum(int $sum): self
    {
        return new self($sum);
    }

    public function __construct(private int $sum)
    {
    }

    public function from(array $items, MaxCount $maxCount = null, int $depth = 1): Generator
    {
        $maxCount ??= MaxCount::infinite();

        $count = count($items);
        if ($count === 0 || $maxCount->exceeded($depth)) {
            return;
        }

        [$value] = $items;
        if ($value === $this->sum) {
            $maxCount->update($depth);
            yield [$value];
            return;
        }

        yield from $this->from(array_slice($items, 1), $maxCount, $depth);

        if ($value > $this->sum) {
            return;
        }

        $remaining = $this->sum - $value;
        $items = array_slice($items, 1);
        $combinations = self::selectSmallestSetsWithSum($remaining);

        foreach ($combinations->from($items, $maxCount, $depth + 1) as $combination) {
            yield [$value, ...$combination];
        }
    }
}
