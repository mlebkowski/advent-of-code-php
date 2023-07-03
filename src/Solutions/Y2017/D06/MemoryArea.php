<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D06;

use Generator;

final readonly class MemoryArea
{
    public static function memoryReallocation($memoryBanks): Generator
    {
        $size = count($memoryBanks);
        while (true) {
            $max = max(...$memoryBanks);
            $idx = array_search($max, $memoryBanks, true);
            $pos = $idx + 1;
            $memoryBanks[$idx] = 0;
            while ($max--) {
                $memoryBanks[$pos++ % $size]++;
            }
            yield $memoryBanks;
        }
    }
}
