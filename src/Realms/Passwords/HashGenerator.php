<?php
declare(strict_types=1);

namespace App\Realms\Passwords;

use Generator;

final readonly class HashGenerator
{
    public static function of(string $input, int $rehashCount = 0): Generator
    {
        $i = 0;
        while (true) {
            yield $i => array_reduce(
                array_fill(0, $rehashCount, null),
                static fn (string $hash) => md5($hash),
                md5($input . $i),
            );
            $i++;
        }
    }
}
