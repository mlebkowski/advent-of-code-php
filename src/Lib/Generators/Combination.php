<?php

declare(strict_types=1);

namespace App\Lib\Generators;

use Generator;

final readonly class Combination
{
    public static function takeWithoutRepeats(int $size): self
    {
        return new self($size, $size);
    }

    public static function rangeWithoutRepeats(int $from, int $to): self
    {
        return new self($from, $to);
    }

    private function __construct(private int $from, private int $to)
    {
    }

    public function from(array $items): Generator
    {
        for ($size = $this->from; $size <= $this->to; $size++) {
            yield from $this->takeOneSize($size, $items);
        }
    }

    private function takeOneSize(int $size, array $items): Generator
    {
        if ($size === 0 || $size > count($items)) {
            yield [];
            return;
        }

        $size = $size - 1;
        $items = [...$items];
        for ($idx = 0; $idx < count($items) - $size; $idx++) {
            $nonRepeating = array_slice($items, $idx + 1);
            foreach (self::takeOneSize($size, $nonRepeating) as $rest) {
                yield [$items[$idx], ...$rest];
            }
        }
    }
}
