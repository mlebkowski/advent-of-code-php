<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D17;

final class JourneyDataProvider
{
    public static function shortest(): iterable
    {
        yield ['ihgpwlah', 'DDRRRD'];
        yield ['kglvqrro', 'DDUDRLRRUDRD'];
        yield ['ulqzkmiv', 'DRURDRUDDLLDLUURRDULRLDUUDDDRR'];
    }

    public static function longest(): iterable
    {
        yield ['ihgpwlah', 370];
        yield ['kglvqrro', 492];
        yield ['ulqzkmiv', 830];
    }
}
