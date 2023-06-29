<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D16;

use Generator;
use loophp\collection\Collection;

final class DragonCurveGenerator
{
    public static function ofInitialState(string $initialState): Generator
    {
        assert(1 === preg_match('/^[01]+$/', $initialState));

        $a = $initialState;
        while (true) {
            $b = strtr(
                Collection::fromString($a)->reverse()->implode(),
                ['1' => '0', '0' => '1'],
            );

            yield $a = $a . '0' . $b;
        }
    }

    public static function reduce(string $data): string
    {
        assert(1 === preg_match('/^[01]+$/', $data));

        $checksum = $data;
        while (strlen($checksum) % 2 === 0) {
            $checksum = Collection::fromString($checksum)
                ->chunk(2)
                ->map(static fn (array $pair) => match ($pair) {
                    ['0', '0'], ['1', '1'] => '1',
                    ['1', '0'], ['0', '1'] => '0',
                })
                ->implode();
        }
        return $checksum;
    }
}
