<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D09;

use RuntimeException;

final class Decompressor
{
    public static function getDecompressedLength(string $input, Format $version): int
    {
        return array_sum(iterator_to_array(self::chunks($input, $version)));
    }

    private static function chunks(string $input, Format $version): iterable
    {
        while (true) {
            $offset = strpos($input, '(');
            if (false === $offset) {
                yield strlen($input);
                return;
            }

            yield $offset;
            $input = substr($input, $offset);

            if ('' === $input) {
                return;
            }

            if (1 !== preg_match('/^\((?P<length>\d+)x(?P<times>\d+)\)/', $input, $match)) {
                $str = substr($input, 0, 15);
                throw new RuntimeException("Expected a valid marker at: $str");
            }

            $input = substr($input, strlen($match[0]));

            $length = (int)$match['length'];
            $times = (int)$match['times'];

            $buffer = substr($input, 0, $length);
            $input = substr($input, $length);
            if (Format::V2 === $version) {
                $length = self::getDecompressedLength($buffer, Format::V2);
            }
            yield $length * $times;
        }

    }
}
