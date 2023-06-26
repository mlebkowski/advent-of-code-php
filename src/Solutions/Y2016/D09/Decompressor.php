<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D09;

use RuntimeException;

final class Decompressor
{
    public static function decompress(string $input, Format $version): string
    {
        return implode('', iterator_to_array(self::decompressParts($input, $version)));
    }

    private static function decompressParts(string $input): iterable
    {
        while (true) {
            $buffer = ('' === $input || $input[0] === '(') ? '' : (string)strtok($input, '(');
            yield $buffer;
            $input = substr($input, strlen($buffer));

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
            yield str_repeat($buffer, $times);
        }

    }
}
