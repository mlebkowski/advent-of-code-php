<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule\Parser;

final class AtomMatcherDataProvider
{
    public static function data(): iterable
    {
        yield ['', ''];
        yield ['foo', ''];
        yield ['Si', 'Si'];
        yield ['BCa', 'BCa, B'];
        yield ['SiTh', 'SiTh, Si'];
        yield ['TiTi', 'TiTi, Ti'];
    }
}
