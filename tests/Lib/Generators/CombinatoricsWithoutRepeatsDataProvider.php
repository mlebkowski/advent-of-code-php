<?php

declare(strict_types=1);

namespace App\Lib\Generators;

final class CombinatoricsWithoutRepeatsDataProvider
{
    public static function data(): iterable
    {
        yield [[1, 2], 0, [[]]];
        yield [[1, 2], 1, [[1], [2]]];
        yield [[1, 2], 2, [[1, 2]]];

        yield [[1, 2, 3], 0, [[]]];
        yield [[1, 2, 3], 1, [[1], [2], [3]]];
        yield [[1, 2, 3], 2, [[1, 2], [1, 3], [2, 3]]];
        yield [[1, 2, 3], 3, [[1, 2, 3]]];
    }

    public static function range(): iterable
    {
        yield [[1, 2, 3], 0, 1, [[], [1], [2], [3]]];
    }
}
