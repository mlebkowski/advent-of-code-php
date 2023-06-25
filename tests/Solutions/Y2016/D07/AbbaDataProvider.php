<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D07;

final class AbbaDataProvider
{
    public static function data(): iterable
    {
        yield ['abba[mnop]qrst', true];
        yield ['abcd[bddb]xyyx', false];
        yield ['aaaa[qwer]tyui', false];
        yield ['ioxxoj[asdfgh]zxcvbn', true];
    }
}
