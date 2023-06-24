<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D04;

final class RoomNamesDataProvider
{
    public static function roomNames(): iterable
    {
        yield ['aaaaa-bbb-z-y-x', 123, 'abxyz', true];
        yield ['a-b-c-d-e-f-g-h', 987, 'abcde', true];
        yield ['not-a-real-room', 404, 'oarel', true];
        yield ['totally-real-room', 200, 'decoy', false];
    }
}
