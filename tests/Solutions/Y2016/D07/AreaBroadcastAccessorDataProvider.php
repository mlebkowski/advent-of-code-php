<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D07;

final class AreaBroadcastAccessorDataProvider
{
    public static function data(): iterable
    {
        yield ['aba[bab]xyz', true];
        yield ['xyx[xyx]xyx', false];
        yield ['aaa[kek]eke', true];
        yield ['zazbz[bzb]cdb', true];
        yield ['abab[aba]xyz', true];
    }
}
