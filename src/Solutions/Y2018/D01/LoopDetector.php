<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D01;

use RuntimeException;

final readonly class LoopDetector
{
    public static function detect(array $sequence): Loop
    {
        $actual = $sequence;
        $index = 0;
        while (++$index) {
            if ($index > count($actual)) {
                $actual = [...$actual, ...$sequence];
            }

            for ($length = 1; $length <= $index; $length++) {
                if (0 === array_sum(array_slice($actual, $index - $length, $length))) {
                    return Loop::of($index - $length, $length);
                }
            }
        }

        throw new RuntimeException('Deficient algo :(');
    }
}
