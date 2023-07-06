<?php
declare(strict_types=1);

namespace App\Realms\Passwords;

use loophp\collection\Collection;

final readonly class KnotHashFactory
{
    public static function make(string $input, int $iterations, array $lengthsToAdd, int $listLength): KnotHash
    {
        assert($iterations > 0);
        $asCharCodes = Collection::fromString($input)
            ->map(static fn (string $char) => ord($char))
            ->all();

        $lengths = Collection::range(0, $iterations)
            ->flatMap(static fn () => [...$asCharCodes, ...$lengthsToAdd])
            ->all();

        $i = 0;
        $list = range(0, $listLength);
        foreach ($lengths as $skipSize => $length) {
            $selection = array_slice($list, 0, $length);
            $skipSize %= count($list);

            $list = array_merge(
                array_slice($list, $length),
                array_reverse($selection),
            );
            $list = array_merge(
                array_slice($list, $skipSize),
                array_slice($list, 0, $skipSize),
            );
            $i = ($i + $length + $skipSize) % count($list);
        }

        $sparseHash = array_merge(
            array_slice($list, -$i),
            array_slice($list, 0, -$i),
        );

        $xor = static fn (array $elements) => array_reduce(
            $elements,
            static fn (int $alpha, int $bravo) => $alpha ^ $bravo,
            0,
        );
        $toHex = static fn (int $number) => str_pad(dechex($number), 2, '0', STR_PAD_LEFT);

        $denseHash = Collection::fromIterable($sparseHash)
            ->chunk(16)
            ->mapN($xor, $toHex)
            ->implode();

        return KnotHash::of($sparseHash, $denseHash);
    }
}
