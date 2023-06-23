<?php
declare(strict_types=1);

namespace App\Solutions\Y2015\D25;

final class CodeGeneratorDataProvider
{
    public static function data(): iterable
    {
        yield [1, 1, 20151125];
        yield [2, 1, 31916031];
        yield [1, 2, 18749137];
        yield [3, 1, 16080970];
        yield [2, 2, 21629792];
        yield [1, 3, 17289845];
        yield [4, 1, 24592653];
        yield [3, 2, 8057251];
        yield [2, 3, 16929656];
        yield [1, 4, 30943339];
    }
}
