<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D16;

use Generator;

final class UniqueMapping
{
    public static function deduce(array $result): array
    {
        $result = iterator_to_array(self::stepByStep($result));
        ksort($result);
        return $result;
    }

    private static function stepByStep(array $result): Generator
    {
        $complete = [];

        while (count($result) > 0) {
            // remove names that has been already associated with an opcode
            $result = array_map(
                static fn (array $names) => array_values(array_diff($names, $complete)),
                $result,
            );
            // sort so we have unambiguous mapping at the top
            uasort(
                $result,
                static fn (array $alpha, array $bravo) => count($alpha) <=> count($bravo),
            );

            $idx = array_key_first($result);
            $names = $result[$idx];
            assert(count($names) === 1);
            [$name] = $names;
            $complete[] = $name;
            yield $idx => OpcodeName::from($name);
            unset($result[$idx]);
        }
    }
}
