<?php
declare(strict_types=1);

namespace App\Realms\Passwords;

use Generator;

final readonly class HashGenerator
{
    public static function of(string $input): Generator
    {
        $i = 0;
        while (true) {
            yield $i => md5($input . $i++);
        }
    }
}
